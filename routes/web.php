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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /************************* LANGUAGES *************************/

    Route::get('/admin/languages', Languages::class)->name('languages');
    Route::get('/admin/languages/create', LanguagesCreate::class)->name('languages.create');
    Route::get('/admin/languages/{language}', LanguagesShow::class)->name('languages.show');
    Route::put('/admin/languages/{language}', [LanguagesController::class, 'update'])->name('languages.update');
    Route::delete('/admin/languages/{language}', [LanguagesController::class, 'destroy'])->name('languages.destroy');
    Route::get('/admin/languages/edit/{language}', LanguagesEdit::class)->name('languages.edit');

    /************************* PORTFOLIO *************************/

    /* PORTFOLIO */
    Route::get('/admin/portfolios', Portfolio::class)->name('portfolios');
    Route::get('/admin/portfolios/create', PortfolioCreate::class)->name('portfolios.create');
    Route::get('/admin/portfolios/{portfolio}', PortfolioShow::class)->name('portfolios.show');
    Route::put('/admin/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::delete('/admin/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
    Route::get('/admin/portfolios/edit/{portfolio}', PortfolioEdit::class)->name('portfolios.edit');

    /* PORTFOLIO TRANSLATIONS */
    Route::get('/admin/portfolios/{portfolio}/translation/create/{missingTranslationId?}', PortfolioTranslationCreate::class)
        ->name('portfolios_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/admin/portfolios_trans', PortfolioTranslation::class)->name('portfolios_trans');
    Route::put('/admin/portfolios_trans/{translation}', [PortfolioTranslationController::class, 'update'])->name('portfolios_trans.update');
    Route::delete('/admin/portfolios_trans/{translation}', [PortfolioTranslationController::class, 'destroy'])->name('portfolios_trans.destroy');
    Route::get('/admin/portfolios_trans/{translation}', PortfolioTranslationShow::class)->name('portfolios_trans.show');
    Route::get('/admin/portfolios_trans/edit/{translation}', PortfolioTranslationEdit::class)->name('portfolios_trans.edit');

    /* PORTFOLIO FILES */
    Route::get('/admin/portfolios/upload/{portfolio}', PortfolioFileUpload::class)->name('portfolios.upload');

    Route::get('/admin/portfolios/{portfolio}/file/{file}', PortfolioFileShow::class)->name('portfoliosfile.show');
    Route::put('/admin/portfolios/{portfolio}/file/{file}', [PortfolioFileController::class, 'update'])->name('portfoliosfile.update');
    Route::get('/admin/portfolios/{portfolio}/file/{file}/edit', PortfolioFileEdit::class)->name('portfoliosfile.edit');

    Route::get('/admin/portfolios/{portfolio}/file/{file}/responsive', [PortfolioFileController::class, 'responsive'])->name('portfoliosfile.responsive');
    Route::get('/admin/portfolios/{portfolio}/file/{image}/responsive/{screen}', [PortfolioFileController::class, 'responsiveCreate'])->name('portfoliosfile.responsiveCreate');
    Route::delete('/admin/portfolios/{portfolio}/file/{image}/responsive/{screen}', [PortfolioFileController::class, 'responsiveDelete'])->name('portfoliosfile.responsiveDelete');
    Route::get('/admin/portfolios/{portfolio}/file/{image}/responsive/{screen}/download', [PortfolioFileController::class, 'responsiveDownload'])->name('portfoliosfile.responsiveDownload');

    Route::get('/admin/portfolios/{portfolio}/file/{file}/download', [PortfolioFileController::class, 'download'])->name('portfoliosfile.download');
    Route::delete('/admin/portfolios/{portfolio}/file/{file}', [PortfolioFileController::class, 'destroy'])->name('portfoliosfile.destroy');

    /* PORTFOLIO FILES TRANSLATIONS */
    Route::get('/admin/portfolios/{portfolio}/file/{file}/translation/create/{missingTranslationId?}', PortfolioFileTranslationCreate::class)
        ->name('portfoliosfile_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/admin/portfolios/{portfolio}/file/{file}/translation/{translation}', PortfolioFileTranslationShow::class)->name('portfoliosfile_trans.show');
    Route::put('/admin/portfolios/{portfolio}/file/{file}/translation/{translation}', [PortfolioFileTranslationController::class, 'update'])->name('portfoliosfile_trans.update');
    Route::delete('/admin/portfolios/{portfolio}/file/{file}/translation/{translation}', [PortfolioFileTranslationController::class, 'destroy'])->name('portfoliosfile_trans.destroy');

    Route::get('/admin/portfolios/{portfolio}/file/{file}/translation/{translation}/edit', PortfolioFileTranslationEdit::class)->name('portfoliosfile_trans.edit');    

    /* PORTFOLIO CATEGORIES */
    Route::get('/admin/pf_categories', PortfolioCategories::class)->name('pf_categories');
    Route::get('/admin/pf_categories/create', PortfolioCategoriesCreate::class)->name('pf_categories.create');
    Route::get('/admin/pf_categories/{category}', PortfolioCategoriesShow::class)->name('pf_categories.show');
    Route::put('/admin/pf_categories/{category}', [PortfolioCategoryController::class, 'update'])->name('pf_categories.update');
    Route::delete('/admin/pf_categories/{category}', [PortfolioCategoryController::class, 'destroy'])->name('pf_categories.destroy');
    Route::get('/admin/pf_categories/edit/{category}', PortfolioCategoriesEdit::class)->name('pf_categories.edit');

    /* PORTFOLIO CATEGORIES TRANSLATIONS */
    Route::get('/admin/pf_categories/{category}/translation/create/{missingTranslationId?}', PortfolioCategoriesTranslationCreate::class)
        ->name('pf_categories_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/admin/pf_categories_trans', PortfolioCategoriesTranslation::class)->name('pf_categories_trans');
    Route::put('/admin/pf_categories_trans/{translation}', [PortfolioCategoryTranslationController::class, 'update'])->name('pf_categories_trans.update');
    Route::delete('/admin/pf_categories_trans/{translation}', [PortfolioCategoryTranslationController::class, 'destroy'])->name('pf_categories_trans.destroy');
    Route::get('/admin/pf_categories_trans/{translation}', PortfolioCategoriesTranslationShow::class)->name('pf_categories_trans.show');

    Route::get('/admin/pf_categories_trans/edit/{translation}', PortfolioCategoriesTranslationEdit::class)->name('pf_categories_trans.edit');

    /* PORTFOLIO TYPES */
    Route::get('/admin/pf_types', PortfolioTypes::class)->name('pf_types');
    Route::get('/admin/pf_types/create', PortfolioTypesCreate::class)->name('pf_types.create');
    Route::get('/admin/pf_types/{type}', PortfolioTypesShow::class)->name('pf_types.show');
    Route::put('/admin/pf_types/{type}', [PortfolioTypeController::class, 'update'])->name('pf_types.update');
    Route::delete('/admin/pf_types/{type}', [PortfolioTypeController::class, 'destroy'])->name('pf_types.destroy');
    Route::get('/admin/pf_types/edit/{type}', PortfolioTypesEdit::class)->name('pf_types.edit');

    /* PORTFOLIO TYPES TRANSLATIONS */
    Route::get('/admin/pf_types/{type}/translation/create/{missingTranslationId?}', PortfolioTypesTranslationCreate::class)
        ->name('pf_types_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/admin/pf_types_trans', PortfolioTypesTranslation::class)->name('pf_types_trans');
    Route::put('/admin/pf_types_trans/{translation}', [PortfolioTypeTranslationController::class, 'update'])->name('pf_types_trans.update');
    Route::delete('/admin/pf_types_trans/{translation}', [PortfolioTypeTranslationController::class, 'destroy'])->name('pf_types_trans.destroy');
    Route::get('/admin/pf_types_trans/{translation}', PortfolioTypesTranslationShow::class)->name('pf_types_trans.show');

    Route::get('/admin/pf_types_trans/edit/{translation}', PortfolioTypesTranslationEdit::class)->name('pf_types_trans.edit');

    /* PORTFOLIO TAGS */
    Route::get('/admin/pf_tags', PortfolioTags::class)->name('pf_tags');
    Route::get('/admin/pf_tags/create', PortfolioTagsCreate::class)->name('pf_tags.create');
    Route::get('/admin/pf_tags/{tag}', PortfolioTagsShow::class)->name('pf_tags.show');
    Route::put('/admin/pf_tags/{tag}', [PortfolioTagController::class, 'update'])->name('pf_tags.update');
    Route::delete('/admin/pf_tags/{tag}', [PortfolioTagController::class, 'destroy'])->name('pf_tags.destroy');
    Route::get('/admin/pf_tags/edit/{tag}', PortfolioTagsEdit::class)->name('pf_tags.edit');

    /* PORTFOLIO TAGS TRANSLATIONS */
    Route::get('/admin/pf_tags/{tag}/translation/create/{missingTranslationId?}', PortfolioTagsTranslationCreate::class)
        ->name('pf_tags_trans.create')
        ->where('missingTranslationId', '[0-9]+');
    Route::get('/admin/pf_tags_trans', PortfolioTagsTranslation::class)->name('pf_tags_trans');
    Route::put('/admin/pf_tags_trans/{translation}', [PortfolioTagTranslationController::class, 'update'])->name('pf_tags_trans.update');
    Route::delete('/admin/pf_tags_trans/{translation}', [PortfolioTagTranslationController::class, 'destroy'])->name('pf_tags_trans.destroy');

    Route::get('/admin/pf_tags_trans/{translation}', PortfolioTagsTranslationShow::class)->name('pf_tags_trans.show');

    Route::get('/admin/pf_tags_trans/edit/{translation}', PortfolioTagsTranslationEdit::class)->name('pf_tags_trans.edit');

});

/* ERRORS */
Route::fallback(function () {
    $errorPath = request()->path();
    //dd($errorPath);
    if (request()->is('admin/*')) {
        // Log the miss
        Log::error('404. Fallback Missing page ADMIN: ', ['path' => $errorPath, 'userId' => Auth::id()]);

        return response()
            ->view('errors.404-admin', ['errorPath' => $errorPath, 'fallback' => true], 404);
    }
    else
    {
        // Log the miss
        Log::error('404. Fallback Missing page FRONTEND: ', ['path' => $errorPath, 'userId' => Auth::id()]);

        return response()
            ->view('errors.404', ['errorPath' => $errorPath, 'fallback' => true], 404);
    }
    
});