<?php

namespace App\Http\Controllers;

use App\Models\Giftcards;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
use App\Helpers\ShopifyHelper;
use Carbon\Carbon;
use App\Helpers\WhatsappHelper;
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
            'internal_code' => 'required|string',
            'pin' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);
        try {
            $codigoSinGuiones = CodeHelper::stripHyphens($request->internal_code);
            if (strlen($codigoSinGuiones) !== 12 || !ctype_alnum($codigoSinGuiones)) {
                return redirect()->back()->with('error', 'Código inválido. Asegúrese de que el código tenga 16 caracteres alfanuméricos.');
            }

            $giftcard = Giftcards::where('internal_code', $codigoSinGuiones)
                ->where('pin', $request->pin)
                ->first();
            Log::error('Info de tienda: ' . $giftcard->lote->tienda->name );

            if ($giftcard) {
                if (!$giftcard->status) {
                    $vigencia_gc = $giftcard->lote->vigencia_gc;
                    $valor_gc = (float) $giftcard->lote->valor_gc;
                    $fechaFormateada = Carbon::parse($vigencia_gc)->format('Y-m-d');

                    $shopify = ShopifyHelper::create_gc($giftcard->code, $valor_gc, $fechaFormateada,$giftcard->lote->tienda->name_shopify,$giftcard->lote->tienda->access_token);
                    if(empty($shopify)){
                        return redirect()->back()->with('error', 'La giftcard no se ha activado correctamente.');
                    }

                    $giftcard->status = true;
                    $giftcard->email = $request->email;
                    $giftcard->name = $request->name;
                    $giftcard->phone = $request->phone;
                    $giftcard->save();

                    WhatsappHelper::newWhatsWelcome($giftcard->code, $request->phone, $fechaFormateada, $valor_gc);
                    return redirect()->back()->with('success', 'Giftcard activada correctamente.');
                } else {
                    return redirect()->back()->with('error', 'La giftcard ya está activada.');
                }
            } else {
                return redirect()->back()->with('error', 'Código o PIN incorrectos. Por favor, verifica la información e intenta nuevamente.');
            }
        } catch (\Exception $e) {
            Log::error('Error al activar la giftcard: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al activar la giftcard. Inténtalo de nuevo más tarde.');
        }
    }
    public function resend(Request $request){
        $giftcard = Giftcards::where('id', $request->query('id'))->first();
        Log::error('Error al enviar whatsapp: ' . $giftcard);

        if($giftcard->status && !empty($giftcard->phone)){
            $fechaFormateada = Carbon::parse($giftcard->lote->vigencia_gc)->format('Y-m-d');
            $valor_gc = (float) $giftcard->lote->valor_gc;

            WhatsappHelper::newWhatsWelcome($giftcard->code, $giftcard->phone, $fechaFormateada, $valor_gc);
            return back()->with('success', '¡Mensaje de Whatsapp enviado con éxito!');
        }
        else{
            return back()->with('error', 'Error al enviar mensaje de whatsapp');

        }

    }

}
