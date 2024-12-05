<?php

namespace App\Livewire\Portfolio\Categories;

use App\Http\Requests\Portfolio\StorePFCategoryRequest;
use App\Models\Portfolio\PortfolioCategory;
use Exception;
use Livewire\Component;

class PortfolioCategoriesCreate extends Component
{
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

    public function save()
    {
        $formData = $this->validate();

        try {
            PortfolioCategory::create($formData);

            return to_route('pf_categories')->with('message', __("generic.category") . ' (' . $this->name . ') '. __("generic.successCreate"));
        } catch (Exception $e) {
            return to_route('pf_categories')->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.category"). ' (' . $this->name . ') '. __("generic.errorCreate"));
        }
    }

    public function render()
    {
        return view('livewire.portfolio.categories.portfolio-categories-create', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-blue-600',
            'textMenuHeader'        => 'hover:text-blue-800',
            'bgMenuColor'           => 'bg-blue-800',
            'bgInfoColor'           => 'bg-blue-100',
            'menuTextColor'         => 'text-blue-800',
            'focusColor'            => 'focus:ring-blue-500 focus:border-blue-500',
            ])->layout('layouts.app');
    }
}
