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
            'menuColor' => 'emerald',
            'menuTextColor' => 'text-emerald-800',
            // Data
            'type' => $this->type
        ])->layout('layouts.app');
    }
    
}
