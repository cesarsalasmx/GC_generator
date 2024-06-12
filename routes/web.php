<?php

use App\Http\Controllers\GiftcardsController;
use App\Http\Controllers\LotesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicGiftcardController;
use App\Http\Controllers\ExportController;
Use App\Http\Controllers\UserController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\TiendaUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
});
Route::get('/activar', [PublicGiftcardController::class, 'showActivationForm'])->name('giftcards.showActivationForm');
Route::post('/activar', [PublicGiftcardController::class, 'activate'])->name('giftcards.activate');
Route::get('/resend', [PublicGiftcardController::class, 'resend'])->name('giftcards.resend');
Route::resource('tiendas', TiendaController::class)->middleware(['auth', 'verified']);
Route::resource('lotes', LotesController::class)->middleware(['auth', 'verified']);
Route::resource('giftcards', GiftcardsController::class)->middleware(['auth', 'verified']);
Route::resource('tienda-user', TiendaUserController::class)->middleware(['auth', 'verified']);

Route::get('/export-pdf/{loteId}', [ExportController::class, 'exportPDF'])->name('export.pdf');
require __DIR__.'/auth.php';
