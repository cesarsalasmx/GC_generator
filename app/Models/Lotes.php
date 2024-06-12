<?php

namespace App\Models;

use App\Models\Giftcards;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'comentarios',
        'cantidad_gc',
        'vigencia_gc',
        'prefijo_gc',
        'valor_gc',
        'user_id',
        'tienda_id'
    ];
    public function giftcards()
    {
        return $this->hasMany(Giftcards::class);
    }
    public function tienda(){
        return $this->belongsTo(Tienda::class);
    }
}
