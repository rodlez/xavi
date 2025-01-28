<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Http\Requests\Portfolio\StorePFCategoryTranslationRequest;
use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use App\Services\TranslationService;
use Exception;
use Livewire\Component;

class PortfolioCategoriesTranslationCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;
    
    public PortfolioCategory $category;
    public string $missingTranslationId;
    public $name;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

     protected function rules(): array
     {
         return (new StorePFCategoryTranslationRequest())->rules();
     }
 
     protected function messages(): array
     {
         return (new StorePFCategoryTranslationRequest())->messages();
     }

    public function boot(
        TranslationService $translationService,
    ) {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioCategory $category, ?string $missingTranslationId = '')
    {
        $this->category = $category;
        // optional parameter to make the translation from the PortfolioCategoryShow Component
        $this->missingTranslationId = $missingTranslationId;
    }

    public function save()
    {
        // TODO: No insert the current cataegory id as pf_cat_id
        // Error(PDOException: SQLSTATE[HY000]: General error: 1364 Field 'pf_cat_id' doesn't have a default value
        
        $this->validate();        

        // Get the language of the translation to show on the returned success or fail message
        $languageName = Languages::where('id', $this->missingTranslationId)
            ->pluck('name')
            ->first();

        try {           
            $this->translationService->insertTranslation('pf_categories_trans', 'pf_cat_id', $this->category->id, $this->missingTranslationId, $this->name);
            return to_route('pf_categories.show', $this->category)->with('message', __('generic.translation') . ' (' . $languageName . ') ' . __('generic.successCreate'));            
        } catch (Exception $e) {
            return to_route('pf_categories.show', $this->category)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $languageName . ') ' . __('generic.errorCreate'));
        }
    }

    public function render()
    {       
        // 1 - Check if the missingTranslationId is a valid Translation Language
        $translationLanguage = Languages::where('id', $this->missingTranslationId)->first();

        if (!$translationLanguage) {
            abort(404, 'Language not found');
        }

        // 2 - Check if the Language have already a translation. if so, no need to give the option to create a new one.
        $isTranslated = $this->translationService->isTranslated($this->category->translations,$this->missingTranslationId);
        
        return view('livewire.portfolio.categories.translations.portfolio-categories-translation-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-blue-400',
            'textMenuHeader' => 'hover:text-blue-400',
            'bgMenuColor' => 'bg-blue-400',
            'bgInfoTab' => 'bg-orange-600',
            'categoryName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'createTranslation' => 'text-white bg-green-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-blue-400',
            'focusColor' => 'focus:ring-blue-400 focus:border-blue-400',
            // Data
            'category' => $this->category,
            'languages' => Languages::all(),
            'translationLanguage' => $translationLanguage,
            'isTranslated' => $isTranslated,
        ])->layout('layouts.app');
    }
}
