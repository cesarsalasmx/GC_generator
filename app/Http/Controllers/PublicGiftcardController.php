<?php

namespace App\Http\Controllers;

use App\Models\Giftcards;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
use App\Helpers\ShopifyHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PublicGiftcardController extends Controller
{
    public function showActivationForm()
    {
        return view('activar');
    }

    public function activate(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'pin' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        // Normaliza el código para la comparación en la base de datos
        $codigoSinGuiones = CodeHelper::stripHyphens($request->code);
        if (strlen($codigoSinGuiones) !== 16 || !ctype_alnum($codigoSinGuiones)) {
            return redirect()->back()->with('error', 'Código inválido. Asegúrese de que el código tenga 16 caracteres alfanuméricos.');
        }

        $giftcard = Giftcards::where('code', $codigoSinGuiones)
                            ->where('pin', $request->pin)
                            ->first();

        if ($giftcard) {
            if (!$giftcard->status) {
                $vigencia_gc = $giftcard->lote->vigencia_gc;
                $valor_gc = (float) $giftcard->lote->valor_gc;

                $giftcard->status = true;
                $giftcard->email = $request->email;
                $giftcard->phone = $request->phone;
                $giftcard->save();

                $fechaFormateada = Carbon::parse($vigencia_gc)->format('Y-m-d');

                $shopify = ShopifyHelper::create_gc($giftcard->code,$valor_gc,$fechaFormateada);
                Log::info('Valor de la variable: ', ['variable' => $shopify]);
                return redirect()->back()->with('success', 'Giftcard activada correctamente.');
            } else {
                return redirect()->back()->with('error', 'La giftcard ya está activada.');
            }
        } else {
            return redirect()->back()->with('error', 'Código o PIN incorrectos. Por favor, verifica la información e intenta nuevamente.');
        }
    }
}
