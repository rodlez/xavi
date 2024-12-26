<?php

namespace App\Livewire\Portfolio\PortfolioTranslations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Models\Portfolio\PortfolioTagTranslation;
use App\Models\Portfolio\PortfolioTranslation;
use App\Models\Portfolio\PortfolioTypeTranslation;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioTranslationEdit extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;    
    public PortfolioTranslation $translation;  

    public function boot(
        TranslationService $translationService,
    ) {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioTranslation $translation)
    {        
        $this->translation = $translation;            
    }

    public function render()
    {
        
        $languages = Languages::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        $categories = PortfolioCategoryTranslation::all()->where('lang_id', $this->translation->lang_id)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $types = PortfolioTypeTranslation::all()->where('lang_id', $this->translation->lang_id)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $tags = PortfolioTagTranslation::all()->where('lang_id', $this->translation->lang_id)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        
        $translationTags = $this->translationService->getPortfolioTranslationTags($this->translation->tags);

        return view('livewire.portfolio.portfolios.translations.portfolio-translation-edit', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-400',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-400',
            'bgInfoTab' => 'bg-orange-600',
            'portfolioName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'editTranslation' => 'text-white bg-blue-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-slate-400',
            'focusColor' => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'translation'   => $this->translation,
            'languages'     => $languages,
            // test
            'categories' => $categories,
            'types' => $types,
            'tags' => $tags,
            'translationTags' => $translationTags,
        ])->layout('layouts.app');
    }
    
}
