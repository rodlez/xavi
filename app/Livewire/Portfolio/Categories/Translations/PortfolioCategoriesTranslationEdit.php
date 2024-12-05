<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use Livewire\Component;

class PortfolioCategoriesTranslationEdit extends Component
{
    public PortfolioCategoryTranslation $translation;

    public function mount(PortfolioCategoryTranslation $translation)
    {        
        $this->translation = $translation;        
    }

    public function render()
    {
        $languages = Languages::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        return view('livewire.portfolio.categories.translations.portfolio-categories-translation-edit', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-blue-400',
            'textMenuHeader'        => 'hover:text-blue-400',
            'bgMenuColor'           => 'bg-blue-400',
            'bgInfoColor'           => 'bg-blue-100',
            'menuTextColor'         => 'text-blue-400',
            'focusColor'            => 'focus:ring-blue-400 focus:border-blue-400',
            // Data
            'translation'   => $this->translation,
            'languages'     => $languages,
        ])->layout('layouts.app');
    }
   
}
