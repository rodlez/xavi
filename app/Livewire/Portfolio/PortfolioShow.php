<?php

namespace App\Livewire\Portfolio;

use App\Models\Languages;
use App\Models\Portfolio\Portfolio;
use App\Services\FileService;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioShow extends Component
{
    protected TranslationService $translationService;
    protected FileService $fileService;

    public Portfolio $portfolio;

    public function boot(TranslationService $translationService, FileService $fileService)
    {
        $this->translationService = $translationService;
        $this->fileService = $fileService;
    }

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function isLandscape($path): string
    {
        $landscape = $this->fileService->isLandscape($path);

        if($landscape){
            return 'landscape';
        }
        else{
            return 'portrait';
        }
    }

    public function render()
    {
        //$missingTranslations = $this->translationService->getTranslationsMissing(PortfolioTranslation::class, 'portfolio_id', $this->portfolio->id);

        $missingTranslations = $this->translationService->getTranslationsMissingTest($this->portfolio);

        return view('livewire.portfolio.portfolio-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgMenuColor' => 'bg-slate-800',
            'bgInfoTab' => 'bg-orange-600',
            'portfolioName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',            
            'bgFilesTab' => 'bg-lime-600',
            'bgTranslationTab' => 'bg-pink-600',
            'menuTextColor' => 'text-slate-800',
            // Data
            'portfolio' => $this->portfolio,
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
   
}
