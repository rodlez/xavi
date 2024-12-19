<?php

namespace App\Livewire\Portfolio;

use App\Http\Requests\Files\StoreFileRequest;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use Intervention\Image\Laravel\Facades\Image;

class PortfolioFileUpload extends Component
{
    use WithFileUploads;

    public Portfolio $portfolio;

    public $files = [];

    public $tempFiles = [];

    public $testini = 0;

    public $validFormats = ['pdf','jpeg','jpg','png'];

    // Dependency Injection to use the Service
    protected FileService $fileService;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

     protected function rules(): array
     {
         return (new StoreFileRequest())->rules();
     }
 
     protected function messages(): array
     {
         return (new StoreFileRequest())->messages();
     }

   /*  protected $rules = [
        'files' => 'array|min:1|max:12',
        //'files.*' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        'files.*' => 'required|file|mimetypes:application/pdf,image/jpeg,image/png',
    ];

    protected $messages = [
        'files.min' => 'Select at least 1 file to upload (max 12 files)',
        'files.max' => 'Limited to 12 files to upload',
        'files.*.required' => 'Select at least one file to upload',
        //'files.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
        'files.*.mimetypes' => 'At least one file do not belong to the allowed formats: PDF, JPG, JPEG, PNG',
    ]; */

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

    public function deleteAllFiles()
    {
        $this->files = [];
        return to_route('portfolios.upload', $this->portfolio);
    }

    public function IsValidFormat($fileExtension): bool
    {
        return in_array($fileExtension, $this->validFormats);
    }

    public function filesWithValidFormats($files): bool
    {
        foreach($files as $file)
        {
            $result = $this->IsValidFormat($file->getClientOriginalExtension());
            if(!$result)
            {
                return false;
            }
        }
        return true;
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

    public function imageLab($file)
    {
        $this->fileService->imageLab($file);
    }

    /**
     * In each update, select a file in the browser, merge the tempFiles with the Files array to have all the possible uploaded files
     */
    public function updated()
    {
        // TODO: CHECKING IF THE FILES ARE THE SAME OR ALREADY ON THE FILES LIST, using getClientOriginalName() and getSize()
        $this->files = array_merge($this->files,$this->tempFiles); 
    }

    public function save()
    {       
        $this->validate();    
        
        // TODO: Use Transactions in case not all the files are uploaded to the drive or create in the DB

        foreach ($this->files as $file) {
            //$storagePath = 'portfoliofiles/' . $file->getClientOriginalExtension();
            $storagePath = 'portfoliofiles/' . $this->portfolio->id;
            $data = $this->fileService->uploadFile($file, $this->portfolio->id, 'portfolio_id', 'public', $storagePath);
            // if there is an error, create method will throw an exception
            PortfolioFile::create($data);   
            if($data == 0)
            {
                return to_route('portfolios.upload', $this->portfolio)->with('error', __("generic.error") . ' (' . $data . ') ' . __("generic.errorUpload"));
            }         
        }
        return to_route('portfolios.upload', $this->portfolio)->with('message', __("generic.files") . ' ' . __("generic.for") . ' (' . $this->portfolio->name . ') ' . __("generic.successUpload"));
                
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
