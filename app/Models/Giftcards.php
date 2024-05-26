<?php

namespace App\Models;
use App\Models\Lotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Giftcards extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'pin',
        'phone',
        'email',
        'status',
        'lotes_id'
    ];
    public function lote()
    {
        return $this->belongsTo(Lotes::class,'lotes_id');
    }
    public static function generateUniqueCode($prefix = '')
    {
        do {
            $random = strtoupper(Str::random(16 - strlen($prefix)));
            $code = $prefix . $random;
        } while (self::where('code', $code)->exists());

        return $code;
    }

    // Método para generar un pin numérico
    public static function generatePin()
    {
        return rand(100, 999); // Genera un número entre 100 y 999.
    }
}
