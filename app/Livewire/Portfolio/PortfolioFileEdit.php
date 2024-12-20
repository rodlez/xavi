<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use Livewire\Component;

class PortfolioFileEdit extends Component
{

    public Portfolio $portfolio;
    public PortfolioFile $file;

    public function mount(Portfolio $portfolio, PortfolioFile $file)
    {
        $this->portfolio = $portfolio;
        $this->file = $file;        
    }

    public function render()
    {
        return view('livewire.portfolio.portfolio-file-edit', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgMenuColor' => 'bg-slate-800',
            'bgInfoColor' => 'bg-slate-100',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Data
            'portfolio' => $this->portfolio,
            'image' => $this->file,
        ])->layout('layouts.app');
    }
  
}
