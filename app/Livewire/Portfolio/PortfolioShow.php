<?php

namespace App\Livewire\Portfolio;

use App\Models\Languages;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
use App\Services\TranslationService;
use Livewire\Component;

class PortfolioShow extends Component
{
    protected TranslationService $translationService;
    protected FileService $fileService;

    public Portfolio $portfolio;
    public PortfolioFile $image;

    
    public function boot(TranslationService $translationService, FileService $fileService)
    {
        $this->translationService = $translationService;
        $this->fileService = $fileService;
    }

    public function mount(Portfolio $portfolio, PortfolioFile $image)
    {
        $this->portfolio = $portfolio;
        $this->image = $image;
        
    }

    public function isLandscape($path): string
    {
        $landscape = $this->fileService->isLandscape($path);

        if($landscape){
            return 'landscape';
        }
        else{
            return 'portrait';
        }
    }      

    public function orderPortfolio(array $images, PortfolioFile $image, string $direction)
    {      
       if ($direction == 'down') 
       {
           // Image to swap
           $imageToSwap = $images[$image->position + 1];
           // Swap Positions
           $image->position = $image->position + 1;
           $imageToSwap['position'] = $imageToSwap['position'] - 1;
       }

       if ($direction == 'up') 
       {
           // Image to swap
           $imageToSwap = $images[$image->position - 1];
           // Swap Positions
           $image->position = $image->position - 1;
           $imageToSwap['position'] = $imageToSwap['position'] + 1;
       }
       
       // UPDATE swaped images positions
       PortfolioFile::where('id', $image->id)->update(['position' => $image->position]); 
       PortfolioFile::where('id', $imageToSwap['id'])->update(['position' => $imageToSwap['position']]);       
    }   

    public function render()
    {
        //$missingTranslations = $this->translationService->getTranslationsMissing(PortfolioTranslation::class, 'portfolio_id', $this->portfolio->id);

        $missingTranslations = $this->translationService->getTranslationsMissingTest($this->portfolio);

        return view('livewire.portfolio.portfolio-show', [
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
            'images' =>   $this->fileService->getFilesbyType($this->portfolio->id, 'image'),
            'documents' =>  $this->fileService->getFilesbyType($this->portfolio->id, 'document'),
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
   
}
