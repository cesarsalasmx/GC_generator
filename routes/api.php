<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\GiftcardsController;
use App\Http\Controllers\Api\V1\SaldoController;

use App\Http\Middleware\VerifyApiToken;
Route::post('v1/giftcards/activate',[GiftcardsController::class ,'activate'])
    ->name('v1.giftcards.activate')
    ->middleware(VerifyApiToken::class);
Route::post('v1/giftcards/saldo',[SaldoController::class ,'update'])
    ->name('v1.giftcards.update');
    //->middleware(VerifyApiToken::class);
