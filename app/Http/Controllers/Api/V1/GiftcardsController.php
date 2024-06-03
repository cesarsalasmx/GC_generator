<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Giftcards;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
use Illuminate\Support\Carbon;
use App\Helpers\ShopifyHelper;
use App\Helpers\WhatsappHelper;
use Illuminate\Support\Facades\Log;


class GiftcardsController extends Controller
{
    public function activate(Request $request){
        Log::error('Error al activar la giftcard: ' . $request->internal_code);

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
                ],400);
                //return redirect()->back()->with('error', 'Código inválido. Asegúrese de que el código tenga 16 caracteres alfanuméricos.');
            }

            $giftcard = Giftcards::where('internal_code', $codigoSinGuiones)
                ->where('pin', $request->pin)
                ->first();

            if ($giftcard) {
                if (!$giftcard->status) {
                    $vigencia_gc = $giftcard->lote->vigencia_gc;
                    $valor_gc = (float) $giftcard->lote->valor_gc;
                    $fechaFormateada = Carbon::parse($vigencia_gc)->format('Y-m-d');

                    $shopify = ShopifyHelper::create_gc($giftcard->code, $valor_gc, $fechaFormateada);
                    if(empty($shopify)){
                        return response()->json([
                            'status' => 500,
                            'code' => 'error',
                            'message' => 'La giftcard no se ha activado correctamente.'
                        ],500);
                        //return redirect()->back()->with('error', 'La giftcard no se ha activado correctamente.');
                    }

                    $giftcard->status = true;
                    $giftcard->email = $request->email;
                    $giftcard->name = $request->name;
                    $giftcard->phone = $request->phone;
                    $giftcard->save();
                    $responseCode = CodeHelper::protectedCode($giftcard->code);
                    WhatsappHelper::newWhatsWelcome($giftcard->code, $request->phone, $fechaFormateada, $valor_gc);
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                        'message' => 'Giftcard activada correctamente.',
                        'giftcard' => $responseCode,
                        'id' => $giftcard->id
                    ],200);
                    //return redirect()->back()->with('success', 'Giftcard activada correctamente.');
                } else {
                    return response()->json([
                        'status' => 500,
                        'code' => 'error',
                        'message' => 'La giftcard no se ha activado correctamente.'
                    ],500);
                    //return redirect()->back()->with('error', 'La giftcard ya está activada.');
                }
            } else {
                return response()->json([
                    'status' => 400,
                    'code' => 'error',
                    'message' => 'Código o PIN incorrectos. Por favor, verifica la información e intenta nuevamente.'
                ],400);
                //return redirect()->back()->with('error', 'Código o PIN incorrectos. Por favor, verifica la información e intenta nuevamente.');
            }
        } catch (\Exception $e) {
            Log::error('Error al activar la giftcard: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'code' => 'error',
                'message' => 'error', 'Ocurrió un error al activar la giftcard. Inténtalo de nuevo más tarde.'
            ],500);
            //return redirect()->back()->with('error', 'Ocurrió un error al activar la giftcard. Inténtalo de nuevo más tarde.');
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
