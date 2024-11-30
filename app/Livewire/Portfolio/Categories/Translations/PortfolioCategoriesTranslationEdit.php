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
            'translation'   => $this->translation,
            'languages'     => $languages,
        ])->layout('layouts.app');
    }
   
}
