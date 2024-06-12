<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giftcards;
use App\Models\Lotes;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportPDF($loteId)
    {
        $user = Auth::user();
        $lote = Lotes::findOrFail($loteId);

        // Verificar el rol del usuario y la propiedad del lote
        if ($user->role == 'shop_manager' && $lote->user_id != $user->id) {
            return redirect()->route('lotes.show', $loteId)->with('error', 'No autorizado para exportar este lote.');
        }

        // Obtener las giftcards relacionadas
        $giftcards = GiftCards::where('lotes_id', $loteId)->get();

        // Generar el PDF
        $pdf = PDF::loadView('lotes.pdf', compact('lote', 'giftcards'));

        // Retornar el PDF para descarga
        return $pdf->download('giftcards_lote_' . $loteId . '.pdf');
    }
}
