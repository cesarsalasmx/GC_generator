<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saldo;
use App\Models\Tienda;
use App\Helpers\ShopifyAPIHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;


class SaldoController extends Controller
{
    public function update(Request $request)
    {
        Log::debug('Contenido de pedido: ' . $request);
        $data = $request->all();
        if (in_array('gift_card', $data['payment_gateway_names'])) {
            $sh_domain = $request->header('X-Shopify-Shop-Domain');
            $shop = Tienda::getTienda('https://'.$sh_domain);
            Log::debug('Se Obtuvo la tienda: ' . $shop['name_shopify']);
            $update = ShopifyAPIHelper::updateSaldo($data['id'],$shop['name_shopify'],Crypt::decryptString($shop['access_token']));
        }
        return response()->json(['message' => 'Saldo actualizado correctamente'], 200);
    }
    public static function store($id_giftcard, $sh_id_giftcard, $saldo){
        Log::debug('Funcion Saldo: ' . $id_giftcard.$sh_id_giftcard.$saldo);

        $saldo = Saldo::create([
            'id_giftcard' => $id_giftcard,
            'sh_id_giftcard' => $sh_id_giftcard,
            'saldo' => $saldo
        ]);
        return $saldo;
    }
}
