<?php

use Illuminate\Support\Facades\Route;
/* Controllers */
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Languages\LanguagesController;
use App\Http\Controllers\Playground;

/* Livewire Full Page Components */
use App\Livewire\Languages\Languages;
use App\Livewire\Languages\LanguagesCreate;
use App\Livewire\Languages\LanguagesEdit;
use App\Livewire\Languages\LanguagesShow;

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

    /* LANGUAGES */
    Route::get('/languages', Languages::class)->name('languages');
    Route::get('/languages/create', LanguagesCreate::class)->name('languages.create');
    Route::get('/languages/{language}', LanguagesShow::class)->name('languages.show');
    Route::put('/languages/{language}', [LanguagesController::class, 'update'])->name('languages.update');
    Route::delete('/languages/{language}', [LanguagesController::class, 'destroy'])->name('languages.destroy');
    Route::get('/languages/edit/{language}', LanguagesEdit::class)->name('languages.edit');


});
