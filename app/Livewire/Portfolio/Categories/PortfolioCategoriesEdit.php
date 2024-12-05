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
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-blue-600',
            'textMenuHeader'        => 'hover:text-blue-800',
            'bgMenuColor'           => 'bg-blue-800',
            'bgInfoColor'           => 'bg-blue-100',
            'menuTextColor'         => 'text-blue-800',
            'focusColor'            => 'focus:ring-blue-500 focus:border-blue-500',
            // Data
            'category' => $this->category
        ])->layout('layouts.app');
    }
   
}
