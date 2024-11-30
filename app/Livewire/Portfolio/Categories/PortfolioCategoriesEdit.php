<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Portfolio\PortfolioCategory;
use Livewire\Component;

class PortfolioCategoriesEdit extends Component
{
    public PortfolioCategory $category;

    public function mount(PortfolioCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.portfolio.categories.portfolio-categories-edit', [
            'category' => $this->category
        ])->layout('layouts.app');
    }

   
}
