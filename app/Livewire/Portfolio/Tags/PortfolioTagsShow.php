<?php

namespace App\Livewire\Portfolio\Tags;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioTag;
use App\Models\Portfolio\PortfolioTagTranslation;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioTagsShow extends Component
{
    protected TranslationService $translationService;
    public PortfolioTag $tag;

    public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioTag $tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        $missingTranslations = $this->translationService->getTranslationsMissing(PortfolioTagTranslation::class, 'pf_tag_id', $this->tag->id);

        return view('livewire.portfolio.tags.portfolio-tags-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-yellow-600',
            'textMenuHeader' => 'hover:text-yellow-800',
            'bgMenuColor' => 'bg-yellow-800',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'menuTextColor' => 'text-yellow-800',
            // Data
            'tag' => $this->tag,
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
}
