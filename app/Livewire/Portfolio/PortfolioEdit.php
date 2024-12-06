<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\Portfolio;
use Livewire\Component;

class PortfolioEdit extends Component
{
    public Portfolio $portfolio;

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function render()
    {
        return view('livewire.portfolio.portfolio-edit', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-slate-600',
            'textMenuHeader'        => 'hover:text-slate-800',
            'bgMenuColor'           => 'bg-slate-800',
            'bgInfoColor'           => 'bg-slate-100',
            'menuTextColor'         => 'text-slate-800',
            'focusColor'            => 'focus:ring-slate-500 focus:border-slate-500',
            // Data
            'portfolio' => $this->portfolio
        ])->layout('layouts.app');
    }
    
}
