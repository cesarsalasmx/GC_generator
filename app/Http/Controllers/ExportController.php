<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giftcards;
use App\Models\Lotes;

use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    //
    public function exportPDF($loteId)
    {
        // Obtener el lote y las giftcards relacionadas
        $lote = Lotes::findOrFail($loteId);
        $giftcards = Giftcards::where('lotes_id', $loteId)->get();

        // Generar el PDF
        $pdf = PDF::loadView('lotes.pdf', compact('lote', 'giftcards'));

        // Retornar el PDF para descarga
        return $pdf->download('giftcards_lote_' . $loteId . '.pdf');
    }
}
