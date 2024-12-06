<?php

namespace App\Livewire\Portfolio\Tags;

use App\Models\Portfolio\PortfolioTag;
use Livewire\Component;

class PortfolioTagsEdit extends Component
{
    public PortfolioTag $tag;

    public function mount(PortfolioTag $tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        return view('livewire.portfolio.tags.portfolio-tags-edit', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-yellow-600',
            'textMenuHeader'        => 'hover:text-yellow-800',
            'bgMenuColor'           => 'bg-yellow-800',
            'bgInfoColor'           => 'bg-yellow-100',
            'menuTextColor'         => 'text-yellow-800',
            'focusColor'            => 'focus:ring-yellow-500 focus:border-yellow-500',
            // Data
            'tag' => $this->tag
        ])->layout('layouts.app');
    }
    
}
