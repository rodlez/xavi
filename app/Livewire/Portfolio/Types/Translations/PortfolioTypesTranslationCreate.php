<?php

namespace App\Livewire\Portfolio\Types\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioType;
use App\Services\TranslationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PortfolioTypesTranslationCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;
    
    public PortfolioType $type;
    public string $missingTranslationId;
    public $name;

    protected $rules = [
        'name' => 'required|min:3',
    ];

    protected $messages = [
        'name.required' => 'The type name is required',
        'name.min' => 'The name must have at least 3 characters',
    ];

    public function boot(
        TranslationService $translationService,
    ) {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioType $type, ?string $missingTranslationId = '')
    {
        $this->type = $type;
        // optional parameter to make the translation from the PortfolioTypeShow Component
        $this->missingTranslationId = $missingTranslationId;
    }

    public function save(Request $request)
    {
        $validated = $this->validate();
        /* $validated['pf_type_id'] = $this->type->id;
        $validated['lang_id'] = $this->translationId;

        // TODO: No insert the current cataegory id as pf_type_id
        // Error(PDOException: SQLSTATE[HY000]: General error: 1364 Field 'pf_type_id' doesn't have a default value
        $translate = PortfolioTypeTranslation::create($validated);

        $translate = PortfolioTypeTranslation::create([
            'caca' => $this->type->id,
            'lang_id' => $this->language_id,
            'name'  => $this->name,
        ]); */

        $languageName = Languages::where('id', $this->missingTranslationId)
            ->pluck('name')
            ->first();

        try {           
            DB::table('pf_types_trans')->insert([
                'pf_type_id'    => $this->type->id,
                'lang_id'       => $this->missingTranslationId,
                'name'          => $this->name,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
            return to_route('pf_types.show', $this->type)->with('message', '(' . $languageName . ') Translation successfully created');
        } catch (Exception $e) {
            return to_route('pf_types.show', $this->type)->with('error', 'Error (' . $e->getCode() . ') Translation in (' . $languageName . ') can not be created');
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
        $isTranslated = $this->translationService->isTranslated($this->type->translations,$this->missingTranslationId);
        
        return view('livewire.portfolio.types.translations.portfolio-types-translation-create', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-emerald-400',
            'textMenuHeader'        => 'hover:text-emerald-400',
            'bgMenuColor'           => 'bg-emerald-400',
            'bgInfoColor'           => 'bg-emerald-100',
            'menuTextColor'         => 'text-emerald-400',
            'focusColor'            => 'focus:ring-emerald-400 focus:border-emerald-400',
            // Data
            'type'                  => $this->type,
            'languages'             => Languages::all(),
            'translationLanguage'   => $translationLanguage,
            'isTranslated'          => $isTranslated,
        ])->layout('layouts.app');
    }
    
}
