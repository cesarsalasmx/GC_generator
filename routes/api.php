<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\GiftcardsController;
use App\Http\Middleware\VerifyApiToken;
Route::post('v1/giftcards/activate',[GiftcardsController::class ,'activate'])
    ->name('v1.giftcards.activate')
    ->middleware(VerifyApiToken::class);
