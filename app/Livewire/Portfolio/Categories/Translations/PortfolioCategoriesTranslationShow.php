<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Models\Portfolio\PortfolioCategoryTranslation;
use Livewire\Component;

class PortfolioCategoriesTranslationShow extends Component
{
    public PortfolioCategoryTranslation $translation;

    public function mount(PortfolioCategoryTranslation $translation)
    {
        $this->translation = $translation;
    }

    public function render()
    {
        return view('livewire.portfolio.categories.translations.portfolio-categories-translation-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-blue-400',
            'textMenuHeader' => 'hover:text-blue-400',
            'bgMenuColor' => 'bg-blue-400',
            'bgInfoTab' => 'bg-orange-600',
            'categoryName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-blue-400',
            'focusColor' => 'focus:ring-blue-400 focus:border-blue-400',
            // Data
            'translation' => $this->translation,
        ])->layout('layouts.app');
    }
}

