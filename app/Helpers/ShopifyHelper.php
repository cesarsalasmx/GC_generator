<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Helpers\ShopifyAPIHelper;
use Illuminate\Support\Facades\Log;


class ShopifyHelper{
    public static function activateGCShopify($code, $initial_value, $expiry_date, $name, $phone, $email, $shop, $accessToken){
        $customer_id = null;
        $customer_data = ShopifyAPIHelper::createClient($name, $email, $phone, $shop, $accessToken);
        if( isset($customer_data["customer"])){
            $customer_id = $customer_data["customer"]["id"];
        }else if(isset($customer_data["errors"])){
            $get_customer_data = ShopifyAPIHelper::getClient($email, $phone, $shop, $accessToken);
            $customer_id = $get_customer_data["customers"][0]["id"];
        }
        if (empty($customer_id)) {
            return 'error';
        }else{
            $sh_id_giftcard = ShopifyAPIHelper::createGiftcard($code, $initial_value, $expiry_date, $customer_id, $shop, $accessToken);
            Log::debug($sh_id_giftcard);
            Log::debug('Token:'.$accessToken);
            Log::debug('Shop:'.$shop);
            return $sh_id_giftcard['gift_card']['id'];
        }
    }


}
