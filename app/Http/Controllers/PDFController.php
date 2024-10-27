<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {

        $pdf = Pdf::loadView('pdf.laudo');

        return $pdf->stream('sample.pdf');
    }
}
