<?php

namespace App\Livewire\Portfolio;

use App\Models\Languages;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioFileShow extends Component
{
    public Portfolio $portfolio;
    public PortfolioFile $file;

    // Dependency Injection to use the Service
    protected FileService $fileService;
    protected TranslationService $translationService;

    // Hook Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
    public function boot(FileService $fileService, TranslationService $translationService)
    {
        $this->fileService = $fileService;
        $this->translationService = $translationService;
    }

    public function mount(Portfolio $portfolio, PortfolioFile $file)
    {
        $this->portfolio = $portfolio;
        $this->file = $file;
    }

    public function render()
    {
        //dd($this->file);
        //dd($this->fileService->imageResponsiveInfo($this->file->path));
        $responsiveImages = $this->fileService->getResponsiveImagesInfo($this->file);

        $totalResponsiveImages = 0;
        if (count($responsiveImages) > 1) {
            foreach ($responsiveImages as $responsiveImage) {
                $responsiveImage['filename'] ? ($totalResponsiveImages = $totalResponsiveImages + 1) : '';
            }
        }

        $missingTranslations = $this->translationService->getTranslationsMissingTest($this->file);
        //dd($missingTranslations);
        //dd($responsiveImages);
        return view('livewire.portfolio.portfolio-file-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgMenuColor' => 'bg-slate-800',
            'bgInfoTab' => 'bg-orange-600',
            'portfolioName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgFilesTab' => 'bg-lime-600',
            'bgTranslationTab' => 'bg-pink-600',
            'menuTextColor' => 'text-slate-800',
            // Data
            'portfolio' => $this->portfolio,
            'image' => $this->file,
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
            'responsiveImages' => $responsiveImages,
            'totalResponsiveImages' => $totalResponsiveImages,
        ])->layout('layouts.app');
    }
}
