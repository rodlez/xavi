<?php

namespace App\Livewire\Portfolio\Types;

use App\Http\Requests\Portfolio\StorePFTypeRequest;
use App\Models\Portfolio\PortfolioType;
use Exception;
use Illuminate\Http\Request;
use Livewire\Component;

class PortfolioTypesCreate extends Component
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
        return (new StorePFTypeRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StorePFTypeRequest())->messages();
    }   

    public function save()
    {
        $formData = $this->validate();

        try {
            PortfolioType::create($formData);

            return to_route('pf_types')->with('message', 'Type (' . $this->name . ') successfully created');
        } catch (Exception $e) {
            return to_route('pf_types')->with('error', 'Error (' . $e->getCode() . ') Type (' . $this->name . ')  can not be created');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.types.portfolio-types-create', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-emerald-600',
            'textMenuHeader'        => 'hover:text-emerald-800',
            'bgMenuColor'           => 'bg-emerald-800',
            'bgInfoColor'           => 'bg-emerald-100',
            'menuTextColor'         => 'text-emerald-800',
            'focusColor'            => 'focus:ring-emerald-500 focus:border-emerald-500',
            ])->layout('layouts.app');
    }
    
}
