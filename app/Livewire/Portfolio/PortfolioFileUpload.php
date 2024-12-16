<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
use Livewire\Component;
use Livewire\WithFileUploads;

class PortfolioFileUpload extends Component
{
    use WithFileUploads;

    public Portfolio $portfolio;

    public $files = [];

    // Dependency Injection to use the Service
    protected FileService $fileService;

    protected $rules = [
        'files' => 'array|min:1|max:5',
        //'files.*' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        'files.*' => 'required|file|mimetypes:text/plain,application/pdf,image/jpeg,image/png,application/vnd.oasis.opendocument.text,application/vnd.openxmlformats-officedocument.wordprocessingml.document,video/mp4|max:1024000',
    ];

    protected $messages = [
        'files.min' => 'Select at least 1 file to upload (max 5 files)',
        'files.max' => 'Limited to 5 files to upload',
        'files.*.required' => 'Select at least one file to upload',
        //'files.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
        'files.*.mimetypes' => 'At least one file do not belong to the allowed formats: PDF, JPG, JPEG, PNG, TXT, DOC, ODT'
    ];

    // Hook Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
    public function boot(
        FileService $fileService,
    ) {
        $this->fileService = $fileService;
    }

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function deleteFile($position)
    {
        array_splice($this->files, $position, 1);
    }

    public function save()
    {       
        //dd($this->validate());

        foreach ($this->files as $file) {
            $storagePath = 'portfoliofiles/' . $file->getClientOriginalExtension();
            $data = $this->fileService->uploadFile($file, $this->portfolio->id, 'portfolio_id', 'public', $storagePath);
            // if there is an error, create method will throw an exception
            PortfolioFile::create($data);            
        }
        
        return to_route('portfolios.show', $this->portfolio)->with('message', 'File(s) for (' . $this->portfolio->name . ') successfully uploaded.');
    }

    public function render()
    {
        return view('livewire.portfolio.portfolio-file-upload', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgMenuColor' => 'bg-slate-800',
            'bgInfoColor' => 'bg-slate-100',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Data
            'portfolio' => $this->portfolio,
        ])->layout('layouts.app');
    }
}
