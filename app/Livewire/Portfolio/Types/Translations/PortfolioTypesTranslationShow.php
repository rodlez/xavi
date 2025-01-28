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
            'underlineMenuHeader' => 'border-b-2 border-b-emerald-400',
            'textMenuHeader' => 'hover:text-emerald-400',
            'bgMenuColor' => 'bg-emerald-400',
            'bgInfoTab' => 'bg-orange-600',
            'typeName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-emerald-400',
            'focusColor' => 'focus:ring-emerald-400 focus:border-emerald-400',
            // Data
            'translation' => $this->translation,
        ])->layout('layouts.app');
    }
}
