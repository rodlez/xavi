<?php

namespace App\Livewire\Portfolio\Types\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Livewire\Component;

class PortfolioTypesTranslationEdit extends Component
{
    public PortfolioTypeTranslation $translation;

    public function mount(PortfolioTypeTranslation $translation)
    {        
        $this->translation = $translation;       
    }

    public function render()
    {
        $languages = Languages::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        return view('livewire.portfolio.types.translations.portfolio-types-translation-edit', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-emerald-400',
            'textMenuHeader'        => 'hover:text-emerald-400',
            'bgMenuColor'           => 'bg-emerald-400',
            'bgInfoColor'           => 'bg-emerald-100',
            'menuTextColor'         => 'text-emerald-400',
            'focusColor'            => 'focus:ring-emerald-400 focus:border-emerald-400',
            // Data
            'translation'   => $this->translation,
            'languages'     => $languages,
        ])->layout('layouts.app');
    }
    
}
