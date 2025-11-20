<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::resource('langues',LangueController::class);




