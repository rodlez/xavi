<?php

namespace App\Livewire\Portfolio;

use App\Models\Languages;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Models\Portfolio\PortfolioFileTranslation;
use Livewire\Component;

class PortfolioFileTranslationShow extends Component
{
    public Portfolio $portfolio;
    public PortfolioFile $file;
    public PortfolioFileTranslation $translation;    

    public function mount(Portfolio $portfolio, PortfolioFile $file, PortfolioFileTranslation $translation, )
    {
        $this->portfolio = $portfolio;
        $this->file = $file;        
        $this->translation = $translation;        
    }

    public function render()
    {
        $languages = Languages::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);

        return view('livewire.portfolio.portfolio-file-translation-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgMenuColor' => 'bg-slate-600',
            'bgInfoTab' => 'bg-orange-600',
            'typeName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'editTranslation' => 'text-white bg-blue-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'languages' => $languages,
        ])->layout('layouts.app');
    }
    
    
}
