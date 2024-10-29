<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Vistoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function geraPDF(string $id)
    {


        $vistoria = Vistoria::where('id', $id)
            ->with('locador')
            ->with('locatario')
            ->with('imobiliaria')
            ->with('vistoriador')
            ->with('ambientes')
            ->get();

        $ambientes = Ambiente::where('vistoria_id', $id)->get();

        $pdf = Pdf::loadView('pdf.laudo', [
            "vistoria" => $vistoria,
            "ambientes" => $ambientes
        ]);

        return $pdf->stream('sample.pdf');
    }
}
