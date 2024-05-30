<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappHelper{
    public static function newWhatsWelcome($code, $numero_tel, $vigencia, $valor)
    {
        $remitente = "César Salas";
        $tienda_cliente = "Café punta del cielo";
        $url = "https://puntadelcielo.com.mx/";
        $lema = "Respeto por el café";
        $template = config('whatsapp.template');
        $api_token = config('whatsapp.api');
        $formattedString = preg_replace('/(.{4})/', '$1-', $code);
        $formattedString = rtrim($formattedString, '-');
        $data = [
            'from' => '5215589202800',
            'to' => '521' . $numero_tel,
            'contents' => [
                [
                    'type' => 'template',
                    'templateId' => $template,
                    'fields' => [
                        'Abono' => $valor,
                        'Remitente' => $remitente,
                        'Cliente' => $tienda_cliente,
                        'URL' => $url,
                        'Lema' => $lema,
                        'Tarjeta' => $formattedString,
                        'Vigencia' => $vigencia,
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-TOKEN' => $api_token,
        ])->post('https://api.zenvia.com/v2/channels/whatsapp/messages', $data);

        return $response->body();
    }
}

