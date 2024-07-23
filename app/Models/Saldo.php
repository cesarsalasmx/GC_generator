<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Giftcards;
class Saldo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_giftcard',
        'saldo',
        'sh_id_giftcard'
    ];
    public function giftcard()
    {
        return $this->belongsTo(Giftcards::class, 'id_giftcard');
    }
    public static function updateSaldo($sh_id_giftcard,$amount){
        $saldo = Saldo::where('sh_id_giftcard', $sh_id_giftcard)->first();

        if ($saldo) {
            $nuevoSaldo = $saldo->saldo - $amount;
            if ($nuevoSaldo < 0) {
                $nuevoSaldo = 0;
            }
            $saldo->saldo = $nuevoSaldo;
            $saldo->save();
        }
    }
}
