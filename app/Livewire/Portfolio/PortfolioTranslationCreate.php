<?php

namespace App\Livewire\Portfolio;

use App\Http\Requests\Portfolio\StorePortfolioTranslationRequest;
use App\Models\Languages;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Models\Portfolio\PortfolioTagTranslation;
use App\Models\Portfolio\PortfolioTypeTranslation;
use App\Services\TranslationService;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PortfolioTranslationCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;
    
    public Portfolio $portfolio;
    public string $missingTranslationId;
    public $title;
    public $subtitle;
    public $content;
    public $year;
    public $location;
    public $client;
    public $project;
    public $pf_cat_trans_id;
    public $pf_type_trans_id;

    public $selectedTags = [];


    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

     protected function rules(): array
     {
         return (new StorePortfolioTranslationRequest())->rules();
     }
 
     protected function messages(): array
     {
         return (new StorePortfolioTranslationRequest())->messages();
     }

    public function boot(
        TranslationService $translationService,
    ) {
        $this->translationService = $translationService;
    }

    public function mount(Portfolio $portfolio, ?string $missingTranslationId = '')
    {
        $this->portfolio = $portfolio;
        // optional parameter to make the translation from the PortfolioShow Component
        $this->missingTranslationId = $missingTranslationId;
        // default avalues for category and type in case the user do not select any
        $this->pf_cat_trans_id = PortfolioCategoryTranslation::where('lang_id', $this->missingTranslationId)->orderBy('name', 'asc')->pluck('id')->first();
        $this->pf_type_trans_id = PortfolioTypeTranslation::where('lang_id', $this->missingTranslationId)->orderBy('name', 'asc')->pluck('id')->first();
    }

    public function save()
    {
        // TODO: No insert the current cataegory id as pf_cat_id
        // Error(PDOException: SQLSTATE[HY000]: General error: 1364 Field 'pf_cat_id' doesn't have a default value
        
        $validated = $this->validate(); 
        dd($validated);
        $validated['portfolio_id'] = $this->portfolio->id;
        $validated['lang_id'] = $this->missingTranslationId;       

        // Get the language of the translation to show on the returned success or fail message
        $languageName = Languages::where('id', $this->missingTranslationId)
            ->pluck('name')
            ->first();
        
        try { 
            $this->translationService->insertTranslationPortfolio($validated);
            
            return to_route('portfolios.show', $this->portfolio)->with('message', __('generic.translation') . ' (' . $languageName . ') ' . __('generic.successCreate'));            
        } catch (Exception $e) {
            return to_route('portfolios.show', $this->portfolio)->with('error', __('generic.error') . ' (' . $e/* ->getCode() */ . ') ' . __('generic.translation') . ' (' . $languageName . ') ' . __('generic.errorCreate'));
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
        $isTranslated = $this->translationService->isTranslated($this->portfolio->translations,$this->missingTranslationId);

        // 3 - Get the Categories and Types for the language of this translation

        $categories = PortfolioCategoryTranslation::all()->where('lang_id', $this->missingTranslationId)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $types = PortfolioTypeTranslation::all()->where('lang_id', $this->missingTranslationId)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $tags = PortfolioTagTranslation::all()->where('lang_id', $this->missingTranslationId)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        
        
        return view('livewire.portfolio.portfolio-translation-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-400',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-400',
            'bgInfoTab' => 'bg-orange-600',
            'portfolioName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'createTranslation' => 'text-white bg-green-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-slate-400',
            'focusColor' => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'portfolio' => $this->portfolio,
            'languages' => Languages::all(),
            'translationLanguage' => $translationLanguage,
            'isTranslated' => $isTranslated,
            // test
            'categories' => $categories,
            'types' => $types,
            'tags' => $tags,
        ])->layout('layouts.app');
    }
    
}
