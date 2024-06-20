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

Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas para TiendaUser
    Route::get('tienda-user', [TiendaUserController::class, 'index'])->name('tienda-user.index');
    Route::get('tienda-user/create', [TiendaUserController::class, 'create'])->name('tienda-user.create');
    Route::post('tienda-user', [TiendaUserController::class, 'store'])->name('tienda-user.store');
    Route::get('tienda-user/{user}/edit', [TiendaUserController::class, 'edit'])->name('tienda-user.edit');
    Route::put('tienda-user/{user}', [TiendaUserController::class, 'update'])->name('tienda-user.update');
});

Route::get('/export-pdf/{loteId}', [ExportController::class, 'exportPDF'])->name('export.pdf');
Route::get('lotes/{lote}/export', [LotesController::class, 'exportGiftcardsToCsv'])->name('lotes.export');
require __DIR__.'/auth.php';
