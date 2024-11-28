<?php

use Illuminate\Support\Facades\Route;
/* Controllers */
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Playground;

/* ------------------------------------------------------------- WEB ------------------------------------------------------------- */

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/contact', function () {
    return 'contact';
})->name('contact');

Route::get('/services', function () {
    return 'services';
})->name('services');

Route::get('/playground', [Playground::class, 'index'])->name('playground');

/* LANGUAGES SWITCH */
Route::get('lang', [LanguageController::class, 'change'])->name("change.lang");

/* ------------------------------------------------------------ ADMIN ------------------------------------------------------------ */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
});
