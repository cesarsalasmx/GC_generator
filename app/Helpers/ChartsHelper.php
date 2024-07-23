<?php
namespace App\Helpers;
use App\Models\Giftcards;
use Illuminate\Support\Facades\DB;

class ChartsHelper{
    public static function pieConvertion(){
        // Obtener el total de giftcards
        $totalGiftcards = Giftcards::count();

        // Obtener el total de giftcards con status verdadero (1)
        $activeGiftcards = Giftcards::where('status', 1)->count();

        // Datos para el gráfico
        $data = [
            ['Status', 'Cantidad'],
            ['Activas: '.$activeGiftcards, $activeGiftcards],
            ['Inactivas: '.$totalGiftcards - $activeGiftcards, $totalGiftcards - $activeGiftcards]
        ];
        return $data;
    }
    public static function showIndicator()
    {
        $totalActive = DB::table('giftcards')
            ->join('lotes', 'giftcards.lotes_id', '=', 'lotes.id')
            ->where('giftcards.status', true)
            ->sum('lotes.valor_gc');
        $totalInactive = DB::table('giftcards')
            ->join('lotes', 'giftcards.lotes_id', '=', 'lotes.id')
            ->where('giftcards.status', false)
            ->sum('lotes.valor_gc');
        $indicatorData= [
            ['Label', 'Value'],
            ['Activas', $totalActive],
            ['Inactivas',  $totalInactive ]
        ];
        return $indicatorData;
    }
}
