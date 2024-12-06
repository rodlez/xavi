<?php

namespace App\Livewire\Portfolio;

use App\Models\Languages;
use App\Models\Portfolio\Portfolio;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioShow extends Component
{
    protected TranslationService $translationService;
    public Portfolio $portfolio;

    public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function render()
    {
        //$missingTranslations = $this->translationService->getTranslationsMissing(PortfolioportfolioTranslation::class, 'pf_portfolio_id', $this->portfolio->id);

        return view('livewire.portfolio.portfolio-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-emerald-600',
            'textMenuHeader' => 'hover:text-emerald-800',
            'bgMenuColor' => 'bg-emerald-800',
            'menuTextColor' => 'text-emerald-800',
            // Data
            'portfolio' => $this->portfolio,
            'languages' => Languages::all(),
            //'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
   
}
