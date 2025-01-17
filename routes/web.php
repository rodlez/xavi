<?php

use Illuminate\Support\Facades\Route;
/* Controllers */
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Languages\LanguagesController;
use App\Http\Controllers\Playground;
use App\Http\Controllers\Portfolio\PortfolioCategoryController;
use App\Http\Controllers\Portfolio\PortfolioCategoryTranslationController;
use App\Http\Controllers\Portfolio\PortfolioController;
use App\Http\Controllers\Portfolio\PortfolioFileController;
use App\Http\Controllers\Portfolio\PortfolioFileTranslationController;
use App\Http\Controllers\Portfolio\PortfolioTagController;
use App\Http\Controllers\Portfolio\PortfolioTagTranslationController;
use App\Http\Controllers\Portfolio\PortfolioTranslationController;
use App\Http\Controllers\Portfolio\PortfolioTypeController;
use App\Http\Controllers\Portfolio\PortfolioTypeTranslationController;
use App\Http\Controllers\Section\Portfolio as SectionPortfolio;
/* Livewire Full Page Components */

use App\Livewire\Languages\Languages;
use App\Livewire\Languages\LanguagesCreate;
use App\Livewire\Languages\LanguagesEdit;
use App\Livewire\Languages\LanguagesShow;
use App\Livewire\Portfolio\Portfolio;
use App\Livewire\Portfolio\Categories\PortfolioCategories;
use App\Livewire\Portfolio\Categories\PortfolioCategoriesCreate;
use App\Livewire\Portfolio\Categories\PortfolioCategoriesEdit;
use App\Livewire\Portfolio\Categories\PortfolioCategoriesShow;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslation;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslationCreate;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslationEdit;
use App\Livewire\Portfolio\Categories\Translations\PortfolioCategoriesTranslationShow;
use App\Livewire\Portfolio\PortfolioCreate;
use App\Livewire\Portfolio\PortfolioEdit;
use App\Livewire\Portfolio\Files\PortfolioFileUpload;
use App\Livewire\Portfolio\Files\PortfolioFileEdit;
use App\Livewire\Portfolio\Files\PortfolioFileShow;
use App\Livewire\Portfolio\Files\Translations\PortfolioFileTranslationCreate;
use App\Livewire\Portfolio\Files\Translations\PortfolioFileTranslationEdit;
use App\Livewire\Portfolio\Files\Translations\PortfolioFileTranslationShow;
use App\Livewire\Portfolio\PortfolioShow;
use App\Livewire\Portfolio\PortfolioTranslations\PortfolioTranslation;
use App\Livewire\Portfolio\PortfolioTranslations\PortfolioTranslationCreate;
use App\Livewire\Portfolio\PortfolioTranslations\PortfolioTranslationEdit;
use App\Livewire\Portfolio\PortfolioTranslations\PortfolioTranslationShow;
use App\Livewire\Portfolio\Tags\PortfolioTags;
use App\Livewire\Portfolio\Tags\PortfolioTagsCreate;
use App\Livewire\Portfolio\Tags\PortfolioTagsEdit;
use App\Livewire\Portfolio\Tags\PortfolioTagsShow;
use App\Livewire\Portfolio\Tags\Translations\PortfolioTagsTranslation;
use App\Livewire\Portfolio\Tags\Translations\PortfolioTagsTranslationCreate;
use App\Livewire\Portfolio\Tags\Translations\PortfolioTagsTranslationEdit;
use App\Livewire\Portfolio\Tags\Translations\PortfolioTagsTranslationShow;
use App\Livewire\Portfolio\Types\PortfolioTypes;
use App\Livewire\Portfolio\Types\PortfolioTypesCreate;
use App\Livewire\Portfolio\Types\PortfolioTypesEdit;
use App\Livewire\Portfolio\Types\PortfolioTypesShow;
use App\Livewire\Portfolio\Types\Translations\PortfolioTypesTranslation;
use App\Livewire\Portfolio\Types\Translations\PortfolioTypesTranslationCreate;
use App\Livewire\Portfolio\Types\Translations\PortfolioTypesTranslationEdit;
use App\Livewire\Portfolio\Types\Translations\PortfolioTypesTranslationShow;

/* ------------------------------------------------------------- WEB ------------------------------------------------------------- */

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/contact', function () {
    return 'contactito';
})->name('contact');

Route::get('/services', function () {
    return 'services';
})->name('services');

Route::get('/playground', [Playground::class, 'index'])->name('playground');

/* PORTFOLIO GALLERY */

Route::get('/portfolio', [SectionPortfolio::class, 'index'])->name('portfolio');
Route::get('/portfolio/{portfolio}', [SectionPortfolio::class, 'show'])->name('portfolio.show');
Route::get('/portfolio/type/{type}', [SectionPortfolio::class, 'types'])->name('portfolio.types');
Route::get('/portfolio/cat/{category}', [SectionPortfolio::class, 'categories'])->name('portfolio.categories');
Route::get('/portfolio/tag/{tag}', [SectionPortfolio::class, 'tags'])->name('portfolio.tags');


/* LANGUAGES SWITCH */
Route::get('lang', [LanguageController::class, 'change'])->name('change.lang');

/* ------------------------------------------------------------ ADMIN ------------------------------------------------------------ */

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    /* DASHBOARD */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /************************* LANGUAGES *************************/

    Route::get('/languages', Languages::class)->name('languages');
    Route::get('/languages/create', LanguagesCreate::class)->name('languages.create');
    Route::get('/languages/{language}', LanguagesShow::class)->name('languages.show');
    Route::put('/languages/{language}', [LanguagesController::class, 'update'])->name('languages.update');
    Route::delete('/languages/{language}', [LanguagesController::class, 'destroy'])->name('languages.destroy');
    Route::get('/languages/edit/{language}', LanguagesEdit::class)->name('languages.edit');

    /************************* PORTFOLIO *************************/

    /* PORTFOLIO */
    Route::get('/portfolios', Portfolio::class)->name('portfolios');
    Route::get('/portfolios/create', PortfolioCreate::class)->name('portfolios.create');
    Route::get('/portfolios/{portfolio}', PortfolioShow::class)->name('portfolios.show');
    Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
    Route::get('/portfolios/edit/{portfolio}', PortfolioEdit::class)->name('portfolios.edit');

    /* PORTFOLIO TRANSLATIONS */
    Route::get('/portfolios/{portfolio}/translation/create/{missingTranslationId?}', PortfolioTranslationCreate::class)
        ->name('portfolios_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/portfolios_trans', PortfolioTranslation::class)->name('portfolios_trans');
    Route::put('/portfolios_trans/{translation}', [PortfolioTranslationController::class, 'update'])->name('portfolios_trans.update');
    Route::delete('/portfolios_trans/{translation}', [PortfolioTranslationController::class, 'destroy'])->name('portfolios_trans.destroy');
    Route::get('/portfolios_trans/{translation}', PortfolioTranslationShow::class)->name('portfolios_trans.show');
    Route::get('/portfolios_trans/edit/{translation}', PortfolioTranslationEdit::class)->name('portfolios_trans.edit');

    /* PORTFOLIO FILES */
    Route::get('/portfolios/upload/{portfolio}', PortfolioFileUpload::class)->name('portfolios.upload');

    Route::get('/portfolios/{portfolio}/file/{file}', PortfolioFileShow::class)->name('portfoliosfile.show');
    Route::put('/portfolios/{portfolio}/file/{file}', [PortfolioFileController::class, 'update'])->name('portfoliosfile.update');
    Route::get('/portfolios/{portfolio}/file/{file}/edit', PortfolioFileEdit::class)->name('portfoliosfile.edit');

    Route::get('/portfolios/{portfolio}/file/{file}/responsive', [PortfolioFileController::class, 'responsive'])->name('portfoliosfile.responsive');
    Route::get('/portfolios/{portfolio}/file/{image}/responsive/{screen}', [PortfolioFileController::class, 'responsiveCreate'])->name('portfoliosfile.responsiveCreate');
    Route::delete('/portfolios/{portfolio}/file/{image}/responsive/{screen}', [PortfolioFileController::class, 'responsiveDelete'])->name('portfoliosfile.responsiveDelete');
    Route::get('/portfolios/{portfolio}/file/{image}/responsive/{screen}/download', [PortfolioFileController::class, 'responsiveDownload'])->name('portfoliosfile.responsiveDownload');

    Route::get('/portfolios/{portfolio}/file/{file}/download', [PortfolioFileController::class, 'download'])->name('portfoliosfile.download');
    Route::delete('/portfolios/{portfolio}/file/{file}', [PortfolioFileController::class, 'destroy'])->name('portfoliosfile.destroy');

    /* PORTFOLIO FILES TRANSLATIONS */

    Route::get('/portfolios/{portfolio}/file/{file}/translation/create/{missingTranslationId?}', PortfolioFileTranslationCreate::class)
        ->name('portfoliosfile_trans.create')
        ->where('missingTranslationId', '[0-9]+');

    Route::get('/portfolios/{portfolio}/file/{file}/translation/{translation}', PortfolioFileTranslationShow::class)->name('portfoliosfile_trans.show');
    Route::put('/portfolios/{portfolio}/file/{file}/translation/{translation}', [PortfolioFileTranslationController::class, 'update'])->name('portfoliosfile_trans.update');
    Route::delete('/portfolios/{portfolio}/file/{file}/translation/{translation}', [PortfolioFileTranslationController::class, 'destroy'])->name('portfoliosfile_trans.destroy');

    Route::get('/portfolios/{portfolio}/file/{file}/translation/{translation}/edit', PortfolioFileTranslationEdit::class)->name('portfoliosfile_trans.edit');

    /* PORTFOLIO TRANSLATIONS */
    /* Route::get('/portfolios/{portfolio}/translation/create/{missingTranslationId?}', PortfolioTranslationCreate::class)
        ->name('portfolios_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/portfolios_trans', PortfolioTranslation::class)->name('portfolios_trans');
    Route::put('/portfolios_trans/{translation}', [PortfolioTranslationController::class, 'update'])->name('portfolios_trans.update');
    Route::delete('/portfolios_trans/{translation}', [PortfolioTranslationController::class, 'destroy'])->name('portfolios_trans.destroy');
    Route::get('/portfolios_trans/{translation}', PortfolioTranslationShow::class)->name('portfolios_trans.show');
    Route::get('/portfolios_trans/edit/{translation}', PortfolioTranslationEdit::class)->name('portfolios_trans.edit'); */

    /* PORTFOLIO CATEGORIES */
    Route::get('/pf_categories', PortfolioCategories::class)->name('pf_categories');
    Route::get('/pf_categories/create', PortfolioCategoriesCreate::class)->name('pf_categories.create');
    Route::get('/pf_categories/{category}', PortfolioCategoriesShow::class)->name('pf_categories.show');
    Route::put('/pf_categories/{category}', [PortfolioCategoryController::class, 'update'])->name('pf_categories.update');
    Route::delete('/pf_categories/{category}', [PortfolioCategoryController::class, 'destroy'])->name('pf_categories.destroy');
    Route::get('/pf_categories/edit/{category}', PortfolioCategoriesEdit::class)->name('pf_categories.edit');

    /* PORTFOLIO CATEGORIES TRANSLATIONS */
    Route::get('/pf_categories/{category}/translation/create/{missingTranslationId?}', PortfolioCategoriesTranslationCreate::class)
        ->name('pf_categories_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/pf_categories_trans', PortfolioCategoriesTranslation::class)->name('pf_categories_trans');
    Route::put('/pf_categories_trans/{translation}', [PortfolioCategoryTranslationController::class, 'update'])->name('pf_categories_trans.update');
    Route::delete('/pf_categories_trans/{translation}', [PortfolioCategoryTranslationController::class, 'destroy'])->name('pf_categories_trans.destroy');
    Route::get('/pf_categories_trans/{translation}', PortfolioCategoriesTranslationShow::class)->name('pf_categories_trans.show');

    Route::get('/pf_categories_trans/edit/{translation}', PortfolioCategoriesTranslationEdit::class)->name('pf_categories_trans.edit');

    /* PORTFOLIO TYPES */
    Route::get('/pf_types', PortfolioTypes::class)->name('pf_types');
    Route::get('/pf_types/create', PortfolioTypesCreate::class)->name('pf_types.create');
    Route::get('/pf_types/{type}', PortfolioTypesShow::class)->name('pf_types.show');
    Route::put('/pf_types/{type}', [PortfolioTypeController::class, 'update'])->name('pf_types.update');
    Route::delete('/pf_types/{type}', [PortfolioTypeController::class, 'destroy'])->name('pf_types.destroy');
    Route::get('/pf_types/edit/{type}', PortfolioTypesEdit::class)->name('pf_types.edit');

    /* PORTFOLIO TYPES TRANSLATIONS */
    Route::get('/pf_types/{type}/translation/create/{missingTranslationId?}', PortfolioTypesTranslationCreate::class)
        ->name('pf_types_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/pf_types_trans', PortfolioTypesTranslation::class)->name('pf_types_trans');
    Route::put('/pf_types_trans/{translation}', [PortfolioTypeTranslationController::class, 'update'])->name('pf_types_trans.update');
    Route::delete('/pf_types_trans/{translation}', [PortfolioTypeTranslationController::class, 'destroy'])->name('pf_types_trans.destroy');
    Route::get('/pf_types_trans/{translation}', PortfolioTypesTranslationShow::class)->name('pf_types_trans.show');

    Route::get('/pf_types_trans/edit/{translation}', PortfolioTypesTranslationEdit::class)->name('pf_types_trans.edit');

    /* PORTFOLIO TAGS */
    Route::get('/pf_tags', PortfolioTags::class)->name('pf_tags');
    Route::get('/pf_tags/create', PortfolioTagsCreate::class)->name('pf_tags.create');
    Route::get('/pf_tags/{tag}', PortfolioTagsShow::class)->name('pf_tags.show');
    Route::put('/pf_tags/{tag}', [PortfolioTagController::class, 'update'])->name('pf_tags.update');
    Route::delete('/pf_tags/{tag}', [PortfolioTagController::class, 'destroy'])->name('pf_tags.destroy');
    Route::get('/pf_tags/edit/{tag}', PortfolioTagsEdit::class)->name('pf_tags.edit');

    /* PORTFOLIO TAGS TRANSLATIONS */
    Route::get('/pf_tags/{tag}/translation/create/{missingTranslationId?}', PortfolioTagsTranslationCreate::class)
        ->name('pf_tags_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/pf_tags_trans', PortfolioTagsTranslation::class)->name('pf_tags_trans');
    Route::put('/pf_tags_trans/{translation}', [PortfolioTagTranslationController::class, 'update'])->name('pf_tags_trans.update');
    Route::delete('/pf_tags_trans/{translation}', [PortfolioTagTranslationController::class, 'destroy'])->name('pf_tags_trans.destroy');

    Route::get('/pf_tags_trans/{translation}', PortfolioTagsTranslationShow::class)->name('pf_tags_trans.show');

    Route::get('/pf_tags_trans/edit/{translation}', PortfolioTagsTranslationEdit::class)->name('pf_tags_trans.edit');
});
