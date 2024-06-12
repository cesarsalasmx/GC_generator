<?php
namespace App\Helpers;

use App\Models\Lotes;


class LotesHelper{
    public static function countActiveGiftcards($lote_id) {
        $lote = Lotes::findOrFail($lote_id);
        $activeGiftcardsCount = $lote->giftcards()->where('status', true)->count();
        return $activeGiftcardsCount;
    }
}
