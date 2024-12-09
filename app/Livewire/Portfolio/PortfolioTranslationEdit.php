<?php

namespace App\Livewire\Portfolio;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Models\Portfolio\PortfolioTranslation;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Livewire\Component;

class PortfolioTranslationEdit extends Component
{
    public PortfolioTranslation $translation;    

    public function mount(PortfolioTranslation $translation)
    {        
        $this->translation = $translation;       
    }

    public function render()
    {
        
        $languages = Languages::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        $categories = PortfolioCategoryTranslation::all()->where('lang_id', $this->translation->lang_id)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $types = PortfolioTypeTranslation::all()->where('lang_id', $this->translation->lang_id)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        return view('livewire.portfolio.portfolio-translation-edit', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-slate-400',
            'textMenuHeader'        => 'hover:text-slate-400',
            'bgMenuColor'           => 'bg-slate-400',
            'bgInfoColor'           => 'bg-slate-100',
            'menuTextColor'         => 'text-slate-400',
            'focusColor'            => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'translation'   => $this->translation,
            'languages'     => $languages,
            // test
            'categories' => $categories,
            'types' => $types,
        ])->layout('layouts.app');
    }
    
}
