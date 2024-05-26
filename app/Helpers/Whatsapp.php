<?php

namespace App\Helpers;

class CodeHelper
{
    function new_whats_welcome($abono, $remitente, $tienda_cliente, $url, $numero_tel, $lema, $tarjeta, $vigencia){
        $curl = curl_init();
        $template = 'd0efcf84-a533-4224-bc24-9f33eeb80020';
        $a = array();
        $a['from'] = '5215589202800';
        $a['to'] = '521'.$numero_tel;
        $a['contents'] = array(
            array(
                'type' => 'template',
                'templateId' => $template,
                'fields' => array(
                    'Abono' => $abono,
                    'Remitente' => $remitente,
                    'Cliente' => $tienda_cliente,
                    'URL' => $url,
                    'lema' => $lema,
                    'Cliente' => $tienda_cliente,
                    'Lema' => $lema,
                    'Tarjeta' => $tarjeta,
                    'Vigencia' => $vigencia,
                )
            )
        );
        $body = json_encode($a);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zenvia.com/v2/channels/whatsapp/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-API-TOKEN: 1KU7_96h5C8YEFFvo9tfDpJFQ3_Jopd7RRGq',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    function format_date(string $date){
        $date_time = new DateTime($date);
        $formato = new IntlDateFormatter(
            'es-MX',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'America/Mexico_City',
            IntlDateFormatter::GREGORIAN,
            "eeee d 'de' LLLL 'de' yyyy"
        );
        return $formato->format($date_time);
    }
    /*
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'es_MX.UTF-8','esp');


    $tel = '5531269267';
    $tienda_cliente = 'Café Punta del Cielo';
    $lema = 'Respeto por el café';
    $url = 'https://puntadelcielo.com.mx/';
    $tarjeta = 'xxxx xxxx xxxx 3456';

    $vigencia = format_date('2024-07-12');

    $result = new_whats_welcome(number_format(1200.00),'Juanito García', $tienda_cliente, $url, $tel, $lema, $tarjeta, $vigencia);
    echo "Result Welcome: " . $result . PHP_EOL;
    */


}
