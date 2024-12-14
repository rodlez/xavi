<?php

namespace App\Livewire\Portfolio\Types\Translations;

use App\Models\Portfolio\PortfolioTypeTranslation;
use Livewire\Component;

class PortfolioTypesTranslationShow extends Component
{
    public PortfolioTypeTranslation $translation;

    public function mount(PortfolioTypeTranslation $translation)
    {
        $this->translation = $translation;
    }

    public function render()
    {
        return view('livewire.portfolio.types.translations.portfolio-types-translation-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-yellow-400',
            'textMenuHeader' => 'hover:text-yellow-400',
            'bgMenuColor' => 'bg-yellow-400',
            'bgInfoTab' => 'bg-orange-600',
            'typeName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-yellow-400',
            'focusColor' => 'focus:ring-yellow-400 focus:border-yellow-400',
            // Data
            'translation' => $this->translation,
        ])->layout('layouts.app');
    }
}
