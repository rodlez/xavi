<?php

namespace App\Livewire\Portfolio\Types;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioType;
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
        //$missingTranslations = $this->translationService->getTranslationsMissing(PortfolioTypeTranslation::class, 'pf_type_id', $this->type->id);

        $missingTranslations = $this->translationService->getTranslationsMissingTest($this->type);

        return view('livewire.portfolio.types.portfolio-types-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-emerald-600',
            'textMenuHeader' => 'hover:text-emerald-800',
            'bgMenuColor' => 'bg-emerald-800',
            'bgInfoTab' => 'bg-orange-600',
            'typeName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'menuTextColor' => 'text-emerald-800',
            // Data
            'type' => $this->type,
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
}
