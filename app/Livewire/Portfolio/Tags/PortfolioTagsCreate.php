<?php

namespace App\Livewire\Portfolio\Tags;

use App\Http\Requests\Portfolio\StorePFTagRequest;
use App\Models\Portfolio\PortfolioTag;
use Exception;
use Livewire\Component;

class PortfolioTagsCreate extends Component
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
        return (new StorePFTagRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StorePFTagRequest())->messages();
    }   

    public function save()
    {
        $formData = $this->validate();

        try {
            PortfolioTag::create($formData);

            return to_route('pf_tags')->with('message', __("generic.tag") . ' (' . $this->name . ') '. __("generic.successCreate"));
        } catch (Exception $e) {
            return to_route('pf_tags')->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.tag"). ' (' . $this->name . ') '. __("generic.errorCreate"));
        }
    }

    public function render()
    {
        return view('livewire.portfolio.tags.portfolio-tags-create', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-yellow-600',
            'textMenuHeader'        => 'hover:text-yellow-800',
            'bgMenuColor'           => 'bg-yellow-800',
            'bgInfoColor'           => 'bg-yellow-100',
            'menuTextColor'         => 'text-yellow-800',
            'focusColor'            => 'focus:ring-yellow-500 focus:border-yellow-500',
            ])->layout('layouts.app');
    }
    
}
