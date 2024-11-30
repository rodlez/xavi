<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use Livewire\Component;

class PortfolioCategoriesShow extends Component
{
    public PortfolioCategory $category;

    public function mount(PortfolioCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {      

        return view('livewire.portfolio.categories.portfolio-categories-show', [
            'category' => $this->category,
            'totalLanguages' => Languages::all()->count(),
        ])->layout('layouts.app');
    }
    
}
