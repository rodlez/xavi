<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\PortfolioTranslation;
use Livewire\Component;

class PortfolioTranslationShow extends Component
{
    public PortfolioTranslation $translation;    

    public function mount(PortfolioTranslation $translation)
    {        
        $this->translation = $translation;       
    }

    public function render()
    {
                
        return view('livewire.portfolio.portfolio-translation-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-400',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-400',
            'bgInfoTab' => 'bg-orange-600',
            'portfolioName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-slate-400',
            'focusColor' => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'translation' => $this->translation
        ])->layout('layouts.app');
    }
    
}
