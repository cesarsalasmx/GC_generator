<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
     protected $table = 'history';

     protected $fillable = [
        'type',
        'content'
    ];
    public static function setTransaction($id_transaction)
    {
        return self::create([
            'type' => 'transaction',
            'content' => $id_transaction
        ]);
    }
    public static function getTransaction($id_transaction)
    {
        return self::where('type', 'transaction')
                   ->where('content', $id_transaction)
                   ->first();
    }
}
