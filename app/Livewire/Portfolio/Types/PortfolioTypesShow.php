<?php

namespace App\Livewire\Portfolio\Types;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioType;
use App\Models\Portfolio\PortfolioTypeTranslation;

use App\Services\TranslationService;
use Livewire\Component;

class PortfolioTypesShow extends Component
{
    protected TranslationService $translationService;
    public PortfolioType $type;

    public function boot(TranslationService $translationService)
    {        
        $this->translationService = $translationService;
    }

    public function mount(PortfolioType $type)
    {
        $this->type = $type;
    }

    public function render()
    {       
       //$missingTranslations = $this->translationService->getPFTypeTranslationsMissing($this->type->id);
       $missingTranslations = $this->translationService->getTranslationsMissing(PortfolioTypeTranslation::class, 'pf_type_id', $this->type->id);

        return view('livewire.portfolio.types.portfolio-types-show', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-emerald-600',
            'textMenuHeader'        => 'hover:text-emerald-800',
            'bgMenuColor'           => 'bg-emerald-800',
            'menuTextColor'         => 'text-emerald-800',
            // Data
            'type'                  => $this->type,
            'languages'             => Languages::all(),
            'missingTranslations'   => $missingTranslations,
        ])->layout('layouts.app');
    }
   
}
