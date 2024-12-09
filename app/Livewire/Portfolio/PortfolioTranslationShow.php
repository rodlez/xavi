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
            'underlineMenuHeader'   => 'border-b-2 border-b-slate-600',
            'textMenuHeader'        => 'hover:text-slate-800',
            'bgMenuColor'           => 'bg-slate-800',
            'bgInfoColor'           => 'bg-slate-100',
            'menuTextColor'         => 'text-slate-800',
            'focusColor'            => 'focus:ring-slate-500 focus:border-slate-500',
            // Data
            'translation' => $this->translation
        ])->layout('layouts.app');
    }
    
}
