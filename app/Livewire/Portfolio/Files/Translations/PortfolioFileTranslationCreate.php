<?php

namespace App\Livewire\Portfolio\Files\Translations;

use App\Http\Requests\Portfolio\StorePortfolioFileTranslationRequest;
use App\Models\Languages;
use App\Models\Portfolio\PortfolioFile;
use App\Services\TranslationService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PortfolioFileTranslationCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;

    public PortfolioFile $file;
    public string $missingTranslationId;
    public $title;
    public $description;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

     protected function rules(): array
     {
         return (new StorePortfolioFileTranslationRequest())->rules();
     }
 
     protected function messages(): array
     {
         return (new StorePortfolioFileTranslationRequest())->messages();
     }

     public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioFile $file, ?string $missingTranslationId = '')
    {
        $this->file = $file;
        // optional parameter to make the translation from the PortfolioTypeShow Component
        $this->missingTranslationId = $missingTranslationId;
    }

    public function save()
    {
        // TODO: No insert the current cataegory id as pf_type_id
        // Error(PDOException: SQLSTATE[HY000]: General error: 1364 Field 'pf_type_id' doesn't have a default value

        // Because title and description are optional, if both are null, no need to do anything
        $validated = $this->validate();
        if($validated['title'] == null && $validated['description'] == null) {
            return to_route('portfoliosfile.show', [$this->file->portfolio, $this->file]);
        }
        
        // Get the language of the translation to show on the returned success or fail message
        $languageName = Languages::where('id', $this->missingTranslationId)
            ->pluck('name')
            ->first();

        try {
            $this->translationService->insertTranslationPortfolioFile('portfolio_files_translation', 'portfolio_file_id', $this->file->id, $this->missingTranslationId, $this->title, $this->description);
            return to_route('portfoliosfile.show', [$this->file->portfolio, $this->file])->with('message', __('generic.translation') . ' (' . $languageName . ') ' . __('generic.successCreate'));
        } catch (Exception $e) {
            return to_route('portfoliosfile.show', [$this->file->portfolio, $this->file])->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $languageName . ') ' . __('generic.errorCreate'));
        }
    }


    public function render()
    {
        // 1 - Check if the missingTranslationId is a valid Translation Language
        $translationLanguage = Languages::where('id', $this->missingTranslationId)->first();

        if (!$translationLanguage) {
            //abort(404, 'Language not found');
            Log::error('404. Admin/FileTranslationCreate Language for translation does not exists.', ['langId' => $this->missingTranslationId, 'userId' => Auth::id()]);
            return view('errors.404-admin', [])->layout('layouts.app');
        }

        // 2 - Check if the Language have already a translation. if so, no need to give the option to create a new one.
        $isTranslated = $this->translationService->isTranslated($this->file->translations, $this->missingTranslationId);

        return view('livewire.portfolio.portfolios.files.translations.portfolio-file-translation-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgMenuColor' => 'bg-slate-800',
            'bgInfoTab' => 'bg-orange-600',
            'typeName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'createTranslation' => 'text-white bg-green-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'file' => $this->file,
            'missingTranslationId' => $this->missingTranslationId,
            'languages' => Languages::all(),
            'translationLanguage' => $translationLanguage,
            'isTranslated' => $isTranslated,
        ])->layout('layouts.app');

    }
}
