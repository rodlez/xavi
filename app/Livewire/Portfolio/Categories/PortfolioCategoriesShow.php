<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
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
       
       $missingTranslations = $this->translationService->getPFCategoryTranslationsMissing($this->category->id);

        return view('livewire.portfolio.categories.portfolio-categories-show', [
            'category' => $this->category,
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
    
}
