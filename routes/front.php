<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class, 'accueil'])->name('accueil');

Route::prefix('contenus')->group(function () {

    Route::get('/', [HomeController::class, 'ShowContents'])->name('contenus.all');
    Route::get('/detail/{contenu}', [HomeController::class, 'ShowContentDetail'])->name('contenu.detail')->middleware(['auth','a_payé']);
});
Route::post('/paiement/callback/',[PaymentController::class,'callback'])->name('paiement.callback');

