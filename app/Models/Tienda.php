<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
        'name_shopify',
        'access_token'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'tienda_user', 'tienda_id', 'user_id');
    }
    public function lotes(){
        return $this->hasMany(Lotes::class);
    }
}
