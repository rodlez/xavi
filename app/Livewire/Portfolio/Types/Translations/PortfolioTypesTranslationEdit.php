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
            'menuColor'     => 'emerald',
            'menuTextColor' => 'text-emerald-800',
            // Data
            'translation'   => $this->translation,
            'languages'     => $languages,
        ])->layout('layouts.app');
    }
    
}
