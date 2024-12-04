<?php

namespace App\Livewire\Portfolio\Types;

use App\Models\Portfolio\PortfolioType;
use Livewire\Component;

class PortfolioTypesEdit extends Component
{
    public PortfolioType $type;

    public function mount(PortfolioType $type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.portfolio.types.portfolio-types-edit', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-emerald-600',
            'textMenuHeader'        => 'hover:text-emerald-800',
            'bgMenuColor'           => 'bg-emerald-800',
            'bgInfoColor'           => 'bg-emerald-100',
            'menuTextColor'         => 'text-emerald-800',
            'focusColor'            => 'focus:ring-emerald-500 focus:border-emerald-500',
            // Data
            'type' => $this->type
        ])->layout('layouts.app');
    }
    
}
