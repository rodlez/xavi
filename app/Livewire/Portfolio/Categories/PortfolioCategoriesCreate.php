<?php

namespace App\Livewire\Portfolio\Categories;

use App\Http\Requests\Portfolio\StorePFCategoryRequest;
use App\Models\Portfolio\PortfolioCategory;
use App\Services\TranslationService;
use Exception;
use Livewire\Component;

class PortfolioCategoriesCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;

    public $autoTranslations;
    public $name;
    public $description;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

    protected function rules(): array
    {
        return (new StorePFCategoryRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StorePFCategoryRequest())->messages();
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
            $inserted = PortfolioCategory::create($formData);
            // Insert AutoTranslations, create ALL the translations for this element using the same name inserted in the form
            if ($this->autoTranslations) {
                foreach ($this->translationService->getLanguageIds() as $languageId) {
                    $this->translationService->insertTranslation('pf_categories_trans', 'pf_cat_id', $inserted->id, $languageId, $formData['name']);
                }
            }
            return to_route('pf_categories')->with('message', __('generic.category') . ' (' . $formData['name'] . ') ' . __('generic.successCreate'));
        } catch (Exception $e) {
            return to_route('pf_categories')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.category') . ' (' . $formData['name'] . ') ' . __('generic.errorCreate'));
        }
    }

    public function render()
    {
        return view('livewire.portfolio.categories.portfolio-categories-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-blue-600',
            'textMenuHeader' => 'hover:text-blue-800',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgMenuColor' => 'bg-blue-800',
            'bgInfoColor' => 'bg-blue-100',
            'menuTextColor' => 'text-blue-800',
            'focusColor' => 'focus:ring-blue-500 focus:border-blue-500',
        ])->layout('layouts.app');
    }
}
