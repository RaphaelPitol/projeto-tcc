<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\AmbienteFoto;
use App\Models\Vistoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    // public function geraPDF(string $id)
    // {


    //     $vistoria = Vistoria::where('id', $id)
    //         ->with('locador')
    //         ->with('locatario')
    //         ->with('imobiliaria')
    //         ->with('vistoriador')
    //         ->with('ambientes')
    //         ->get();

    //     $ambientes = Ambiente::where('vistoria_id', $id)->get();

    //     $pdf = Pdf::loadView('pdf.laudo', [
    //         "vistoria" => $vistoria,
    //         "ambientes" => $ambientes
    //     ]);

    //     $pdf->setOption('isHtml5ParserEnabled', true);
    //     $pdf->setOption('isRemoteEnabled', true);


    //     $dompdf = $pdf->getDomPDF();
    //     $dompdf->render();

    //     $canvas = $dompdf->get_canvas();
    //     if ($canvas) {
    //         $canvas->page_text(
    //             500,
    //             800,
    //             "Página {PAGE_NUM} de {PAGE_COUNT}",
    //             null,
    //             10,
    //             [0, 0, 0]
    //         );
    //     } else {
    //         throw new \Exception("Canvas não pôde ser inicializado. Verifique as configurações do DOMPDF.");
    //     }

    //     return $pdf->stream('laudo.pdf');
    // }

    public function geraPDF(string $id)
    {
        $vistoria = Vistoria::with([
            'locador',
            'locatario',
            'imobiliaria',
            'vistoriador',
            'ambientes.fotos' // 🔥 AQUI está o pulo do gato
        ])
            ->findOrFail($id);

        $pdf = Pdf::loadView('pdf.laudo', [
            'vistoria' => $vistoria
        ]);

        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        $canvas = $dompdf->get_canvas();
        if ($canvas) {
            $canvas->page_text(
                500,
                800,
                "Página {PAGE_NUM} de {PAGE_COUNT}",
                null,
                10,
                [0, 0, 0]
            );
        }

        return $pdf->stream('laudo.pdf');
    }
}
