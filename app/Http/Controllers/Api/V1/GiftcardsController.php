<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Giftcards;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
use Illuminate\Support\Carbon;
use App\Helpers\ShopifyHelper;
use App\Helpers\WhatsappHelper;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Api\V1\SaldoController;
use Illuminate\Support\Facades\Log;


class GiftcardsController extends Controller
{
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
                return response()->json([
                    'status' => 400,
                    'code' => 'error',
                    'message' => 'Código inválido. Asegúrese de que el código tenga 12 caracteres alfanuméricos.'
                ], 400);
            }

            $giftcard = Giftcards::where('internal_code', $codigoSinGuiones)
                ->where('pin', $request->pin)
                ->first();

            if ($giftcard) {
                if (!$giftcard->status) {
                    $vigencia_gc = $giftcard->lote->vigencia_gc;
                    $valor_gc = (float) $giftcard->lote->valor_gc;
                    $fechaFormateada = Carbon::parse($vigencia_gc)->format('Y-m-d');
                    $shopify = ShopifyHelper::activateGCShopify($giftcard->code, $valor_gc, $fechaFormateada, $request->name, $request->phone, $request->email, $giftcard->lote->tienda->name_shopify, Crypt::decryptString($giftcard->lote->tienda->access_token));

                    if (empty($shopify)) {
                        return response()->json([
                            'status' => 502,
                            'code' => 'error',
                            'message' => 'La giftcard no se ha activado correctamente debido a un problema en la conexión con la tienda.'
                        ], 502);
                    } else if ($shopify == 'error') {
                        return response()->json([
                            'status' => 409,
                            'code' => 'error',
                            'message' => 'El telefono y el email no coinciden, verifica la información.'
                        ], 409);
                    }

                    $giftcard->status = true;
                    $giftcard->email = $request->email;
                    $giftcard->name = $request->name;
                    $giftcard->phone = $request->phone;
                    $giftcard->save();
                    $responseCode = CodeHelper::protectedCode($giftcard->code);
                    SaldoController::store($giftcard->id,$shopify,$valor_gc);
                    WhatsappHelper::newWhatsWelcome($giftcard->code, $request->phone, $fechaFormateada, $valor_gc);
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                        'message' => 'Giftcard activada correctamente.',
                        'giftcard' => $responseCode,
                        'id' => $giftcard->id
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 422,
                        'code' => 'error',
                        'message' => 'La giftcard no se ha activado correctamente.'
                    ], 422);
                }
            } else {
                return response()->json([
                    'status' => 409,
                    'code' => 'error',
                    'message' => 'Código o PIN incorrectos. Por favor, verifica la información e intenta nuevamente.'
                ], 409);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'code' => 'error',
                'message' => 'error', 'Ocurrió un error al activar la giftcard. Inténtalo de nuevo más tarde.'
            ], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Giftcards $giftcards)
    {
        return $giftcards;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Giftcards $giftcards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Giftcards $giftcards)
    {
        //
    }
}
