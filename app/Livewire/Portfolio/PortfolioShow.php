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
    //public PortfolioFile $image;

    public $reload;

    public function boot(TranslationService $translationService, FileService $fileService)
    {
        $this->translationService = $translationService;
        $this->fileService = $fileService;
    }

    public function mount(Portfolio $portfolio, PortfolioFile $image)
    {
        $this->portfolio = $portfolio;
        //$this->image = $image;
        $this->reload = 0;
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

    

    public function orderPortfolio($images, $image, $direction)
    {
       /*  var_dump($image);
        var_dump($images);

        $key = array_search($image, $images);

        dd($key); */
        //dd($image);

        $this->fileService->orderPortfolioGallery($images, $image, $direction);
        /* dd('oli');
        return redirect()->back(); */
        // Trigger a component refresh
        $this->reload++;    
        dd($this->reload);
    }

    protected function refreshComponent()
    {
        dd('AAAAAAAAAAAAAAAAAAAAH');
        $this->dispatch('$refresh');
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
            'images' =>  $this->fileService->getFilesbyType('image'),
            'documents' =>  $this->fileService->getFilesbyType('document'),
            'languages' => Languages::all(),
            'missingTranslations' => $missingTranslations,
        ])->layout('layouts.app');
    }
   
}
