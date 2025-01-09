<?php

namespace App\Livewire\Portfolio\Types;

use App\Http\Requests\Portfolio\StorePFTypeRequest;
use App\Models\Portfolio\PortfolioType;
use App\Services\TranslationService;
use Exception;
use Livewire\Component;

class PortfolioTypesCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;

    public $autoTranslations;
    public $name;
    public $position;
    public $color;
    public $description;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array. 
     * In this method, you can return the rules() method from your Form Request. 
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */
    
    protected function rules(): array
    {
        return (new StorePFTypeRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StorePFTypeRequest())->messages();
    }

    public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function mount()
    {
        $this->autoTranslations = false;
    }

    public function save()
    {
        $formData = $this->validate();

        try {
            $inserted = PortfolioType::create($formData);
            // Insert AutoTranslations, create ALL the translations for this element using the same name inserted in the form
            if ($this->autoTranslations) {
                foreach ($this->translationService->getLanguageIds() as $languageId) {
                    $this->translationService->insertTranslation('pf_types_trans', 'pf_type_id', $inserted->id, $languageId, $formData['name']);
                }
            }

            return to_route('pf_types')->with('message', __("generic.type") . ' (' . $formData['name'] . ') '. __("generic.successCreate"));
        } catch (Exception $e) {
            return to_route('pf_types')->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.type"). ' (' . $formData['name'] . ') '. __("generic.errorCreate"));
        }
    }

    public function render()
    {
        return view('livewire.portfolio.types.portfolio-types-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-emerald-600',
            'textMenuHeader' => 'hover:text-emerald-800',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgMenuColor' => 'bg-emerald-800',
            'bgInfoColor' => 'bg-emerald-100',
            'menuTextColor' => 'text-emerald-800',
            'focusColor' => 'focus:ring-emerald-500 focus:border-emerald-500',
            ])->layout('layouts.app');
    }
    
}
