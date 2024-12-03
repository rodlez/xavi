<?php

use Illuminate\Support\Facades\Route;
/* Controllers */
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Languages\LanguagesController;
use App\Http\Controllers\Playground;
use App\Http\Controllers\Portfolio\PortfolioCategoryController;
use App\Http\Controllers\Portfolio\PortfolioCategoryTranslationController;
/* Livewire Full Page Components */

use App\Livewire\Languages\Languages;
use App\Livewire\Languages\LanguagesCreate;
use App\Livewire\Languages\LanguagesEdit;
use App\Livewire\Languages\LanguagesShow;
use App\Livewire\Portfolio\Categories\PortfolioCategories;
use App\Livewire\Portfolio\Categories\PortfolioCategoriesCreate;
use App\Livewire\Portfolio\Categories\PortfolioCategoriesEdit;
use App\Livewire\Portfolio\Categories\PortfolioCategoriesShow;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslation;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslationCreate;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslationEdit;

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

    /* PORTFOLIO CATEGORIES */
    Route::get('/pf_categories', PortfolioCategories::class)->name('pf_categories');
    Route::get('/pf_categories/create', PortfolioCategoriesCreate::class)->name('pf_categories.create');
    Route::get('/pf_categories/{category}', PortfolioCategoriesShow::class)->name('pf_categories.show');
    Route::put('/pf_categories/{category}', [PortfolioCategoryController::class, 'update'])->name('pf_categories.update');
    Route::delete('/pf_categories/{category}', [PortfolioCategoryController::class, 'destroy'])->name('pf_categories.destroy');
    Route::get('/pf_categories/edit/{category}', PortfolioCategoriesEdit::class)->name('pf_categories.edit');

    /* PORTFOLIO CATEGORIES TRANSLATIONS */
    Route::get('/pf_categories/{category}/translation/create/{missingTranslationId?}', PortfolioCategoriesTranslationCreate::class)->name('pf_categories_trans.create')->where('missingTranslationId', '[0-9]+');
    Route::get('/pf_categories_trans', PortfolioCategoriesTranslation::class)->name('pf_categories_trans');
    Route::put('/pf_categories_trans/{translation}', [PortfolioCategoryTranslationController::class, 'update'])->name('pf_categories_trans.update');
    Route::delete('/pf_categories_trans/{translation}', [PortfolioCategoryTranslationController::class, 'destroy'])->name('pf_categories_trans.destroy');
    Route::get('/pf_categories_trans/edit/{translation}', PortfolioCategoriesTranslationEdit::class)->name('pf_categories_trans.edit');

});
