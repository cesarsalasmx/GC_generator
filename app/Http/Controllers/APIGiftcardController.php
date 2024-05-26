<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giftcards;
use App\Models\Lotes;

class APIGiftcardController extends Controller
{
    public function activate(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'code' => 'required|string',
            'pin' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string'
        ]);

        // Buscar la giftcard
        $giftcard = Giftcards::where('code', $request->giftcard)
                            ->where('pin', $request->pin)
                            ->first();

        if (!$giftcard) {
            return response()->json(['message' => 'Giftcard not found or invalid pin'], 404);
        }

        // Actualizar la giftcard con la información del usuario
        $giftcard->email = $request->email;
        $giftcard->phone = $request->phone;
        $giftcard->status = true; // Asumiendo que tienes un campo de status
        $giftcard->save();

        // Obtener la información del lote
        $lotes = Lotes::find($giftcard->lotes_id);

        return response()->json([
            'message' => 'Success',
            'giftcard_id' => $giftcard->id,
            'expiry_date' => $lotes->vigencia_gc,
            'value' => $lotes->valor
        ], 200);
    }
}
