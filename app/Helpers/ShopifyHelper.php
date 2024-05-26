<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopifyHelper{
    public static function create_gc ($code, $initial_value, $expiry_date){
        Log::info("LOG de Variables: $code, $initial_value, $expiry_date");
        // $shop = config('services.shopify.shop_name'); // Obtener el nombre de la tienda desde la configuración
        // $accessToken = config('services.shopify.access_token'); // Obtener el token de acceso desde la configuración
        $shop = 'urano028'; // Obtener el nombre de la tienda desde la configuración
        $accessToken = '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'; // Obtener el token de acceso desde la configuración

        $url = "https://$shop.myshopify.com/admin/api/2023-10/gift_cards.json";
        $postData = [
            "gift_card" => [
                "initial_value" => (float) $initial_value, // Asegúrate de que el valor inicial sea un número.
                "code" => $code,
                "template_suffix" => "gift_cards.birthday.liquid",
                "expires_on" => $expiry_date
            ]
        ];
        // Realizar la solicitud HTTP usando la Facade Http de Laravel
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $accessToken,
        ])->post($url, $postData);

        return $response->json();
    }
}

// $r = create_gc('XXXM24EJXGLOFPRJ', 100, '2024-10-10');
// var_dump($r);
