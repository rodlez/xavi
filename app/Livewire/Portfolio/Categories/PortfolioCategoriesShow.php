<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioCategoriesShow extends Component
{
    protected TranslationService $translationService;
    public PortfolioCategory $category;

    public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $missingTranslations = $this->translationService->getTranslationsMissing(PortfolioCategoryTranslation::class, 'pf_cat_id', $this->category->id);

        return view('livewire.portfolio.categories.portfolio-categories-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-blue-600',
            'textMenuHeader' => 'hover:text-blue-800',
            'bgMenuColor' => 'bg-blue-800',
            'menuTextColor' => 'text-blue-800',
            // Data
            'category' => $this->category,
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
}
