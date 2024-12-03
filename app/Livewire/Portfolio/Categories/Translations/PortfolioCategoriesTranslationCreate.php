<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Services\TranslationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PortfolioCategoriesTranslationCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;
    
    public PortfolioCategory $category;
    public string $missingTranslationId;

    //public $language_id;
    public $name;

    public $translationId;

    protected $rules = [
        'name' => 'required|min:3',
        /* 'language_id'       => 'required', */
    ];

    protected $messages = [
        'name.required' => 'The name is required',
        'name.min' => 'The name must have at least 3 characters',
        /* 'language_id.required' => 'The language is required', */
    ];

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

    public function save(Request $request)
    {
        $validated = $this->validate();
        /* $validated['pf_cat_id'] = $this->category->id;
        $validated['lang_id'] = $this->translationId;

        // TODO: No insert the current cataegory id as pf_cat_id
        // Error(PDOException: SQLSTATE[HY000]: General error: 1364 Field 'pf_cat_id' doesn't have a default value
        $translate = PortfolioCategoryTranslation::create($validated);

        $translate = PortfolioCategoryTranslation::create([
            'caca' => $this->category->id,
            'lang_id' => $this->language_id,
            'name'  => $this->name,
        ]); */

        $languageName = Languages::where('id', $this->missingTranslationId)
            ->pluck('name')
            ->first();

        try {           
            DB::table('pf_categories_trans')->insert([
                'pf_cat_id' => $this->category->id,
                'lang_id' => $this->missingTranslationId,
                'name' => $this->name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return to_route('pf_categories.show', $this->category)->with('message', '(' . $languageName . ') Translation successfully created');
        } catch (Exception $e) {
            return to_route('pf_categories.show', $this->category)->with('error', 'Error (' . $e->getCode() . ') Translation in (' . $languageName . ') can not be created');
        }
    }

    public function render()
    {
        /* var_dump($this->missingTranslationId);
        dd('oli');  */

        /* $idNumber = (int)$this->missingTranslationId;
        var_dump($idNumber);
        dd($idNumber); */
        
        /* $translationLanguage = Languages::where('code', $this->missingTranslation)->get()->toArray();

        dd($translationLanguage[0]['code']); */

        // 1 - Check if the missingTranslationId is a valid Translation Language
        $translationLanguage = Languages::where('id', $this->missingTranslationId)->first();

        /* dd($translationLanguage); */

        if (!$translationLanguage) {
            abort(404, 'Language not found');
        }

        // 2 - Check if the Language have already a translation. if so, no need to give the option to create a new one.
        $isTranslated = $this->translationService->isTranslated($this->category->translations,$this->missingTranslationId);
        //dd($isTranslated);
        //$this->translationId = $translationLanguage->id;

        /* if ($translationLanguage)
        {
            dd($translationLanguage);
        }
        else {
            dd('vacio');
        } */

        return view('livewire.portfolio.categories.translations.portfolio-categories-translation-create', [
            'category' => $this->category,
            'languages' => Languages::all(),
            'translationLanguage' => $translationLanguage,
            'isTranslated' => $isTranslated,
        ])->layout('layouts.app');
    }
}
