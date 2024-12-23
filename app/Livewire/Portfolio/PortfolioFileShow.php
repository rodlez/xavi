<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
use Livewire\Component;

class PortfolioFileShow extends Component
{
    public Portfolio $portfolio;
    public PortfolioFile $file;

    // Dependency Injection to use the Service
    protected FileService $fileService;

    // Hook Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
    public function boot(
        FileService $fileService,
    ) {
        $this->fileService = $fileService;
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
            'responsiveImages' => $responsiveImages,
        ])->layout('layouts.app');
    }
}
