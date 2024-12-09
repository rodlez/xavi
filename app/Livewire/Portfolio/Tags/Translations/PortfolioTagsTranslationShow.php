<?php

namespace App\Livewire\Portfolio\Tags\Translations;

use App\Models\Portfolio\PortfolioTagTranslation;
use Livewire\Component;

class PortfolioTagsTranslationShow extends Component
{
    public PortfolioTagTranslation $translation;    

    public function mount(PortfolioTagTranslation $translation)
    {        
        $this->translation = $translation;       
    }

    public function render()
    {
        return view('livewire.portfolio.tags.translations.portfolio-tags-translation-show', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-yellow-400',
            'textMenuHeader'        => 'hover:text-yellow-400',
            'bgMenuColor'           => 'bg-yellow-400',
            'bgInfoColor'           => 'bg-yellow-100',
            'menuTextColor'         => 'text-yellow-400',
            'focusColor'            => 'focus:ring-yellow-400 focus:border-yellow-400',
            // Data
            'translation' => $this->translation
        ])->layout('layouts.app');
    }
    
}
