<?php

use App\Http\Controllers\APIGiftcardController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('/activate-giftcard', [APIGiftcardController::class, 'activate']);
});
