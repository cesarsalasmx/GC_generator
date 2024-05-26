<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopifyHelper{
    public static function create_gc ($code, $initial_value, $expiry_date){
        $shop = config('shop.shop');
        $accessToken = config('shop.access_token');
        $url = "https://$shop.myshopify.com/admin/api/2023-10/gift_cards.json";
        $postData = [
            "gift_card" => [
                "initial_value" => (float) $initial_value, // Asegúrate de que el valor inicial sea un número.
                "code" => $code,
                "template_suffix" => "gift_cards.birthday.liquid",
                "expires_on" => $expiry_date
            ]
        ];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $accessToken,
        ])->post($url, $postData);

        return $response->json();
    }
}
