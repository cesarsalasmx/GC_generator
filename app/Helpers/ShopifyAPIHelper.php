<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Models\History;
use Illuminate\Support\Facades\Log;
use App\Models\Saldo;

class ShopifyAPIHelper{

    public static function getClient($email, $phone, $shop, $accessToken) {
        $url = "https://$shop.myshopify.com/admin/api/2024-01/customers/search.json";
        $query = "email:$email AND phone:$phone";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $accessToken,
        ])->get($url, ['query' => $query]);

        return $response->json();
    }
    public static function createClient($name, $email, $phone, $shop, $accessToken){
        $url = "https://$shop.myshopify.com/admin/api/2024-01/customers.json";
        $postData = [
            "customer" => [
                "first_name" => $name,
                "email" => $email,
                "phone" => $phone,
                "verified_email" => true,
                "send_email_welcome" => false
            ]
        ];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $accessToken,
        ])->post($url, $postData);
        return $response->json();
    }
    public static function createGiftcard($code, $initial_value, $expiry_date, $customer_id, $shop, $accessToken){
        $url = "https://$shop.myshopify.com/admin/api/2023-10/gift_cards.json";
        $postData = [
            "gift_card" => [
                "initial_value" => (float) $initial_value, // Asegúrate de que el valor inicial sea un número.
                "code" => $code,
                "template_suffix" => "gift_cards.birthday.liquid",
                "expires_on" => $expiry_date,
                "customer_id" => $customer_id
            ]
        ];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $accessToken,
        ])->post($url, $postData);
        return $response->json();
    }
    public static function updateSaldo($id_transaction, $shop, $accessToken)
    {
        $url = "https://$shop.myshopify.com/admin/api/2024-04/orders/$id_transaction/transactions.json";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $accessToken
        ])->get($url);

        if ($response->successful()) {
            $transactions = $response->json('transactions', []);
            $filteredTransactions = array_filter($transactions, function($transaction) {
                return $transaction['gateway'] === 'gift_card' && $transaction['status'] === 'success';
            });
            foreach ($filteredTransactions as $transaction) {
                $existingTransaction = History::getTransaction($transaction['id']);
                if (!$existingTransaction) {
                    $giftCardId = $transaction['receipt']['gift_card_id'];
                    $amount = $transaction['amount'];
                    Saldo::updateSaldo($giftCardId, $amount);
                    History::setTransaction($transaction['id']);
                    Log::debug('Se paso por el Update ');

                }
            }
        }
    }
}
