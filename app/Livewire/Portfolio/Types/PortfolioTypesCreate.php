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

    /* protected $rules = [
        'name' => 'required|min:3|unique:pf_types,name',
        'description' => 'nullable|min:3',
    ];

    protected $messages = [
        'name.required' => 'The type name is required',
        'name.min' => 'The type name must have at least 3 characters',
        'name.unique' => 'This type is already created',
        'description.min' => 'If there is a description must have at least 3 characters',
    ]; */

    public function save(StorePFTypeRequest $request)
    {
        //dd('oli');
        //$validated = $this->validate();
        $validated = $request->validate();
        try {
            PortfolioType::create($validated);

            return to_route('pf_types')->with('message', 'Type (' . $this->name . ') successfully created');
        } catch (Exception $e) {
            return to_route('pf_types')->with('error', 'Error (' . $e->getCode() . ') Type (' . $this->name . ')  can not be created');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.types.portfolio-types-create', [
            // Styles
            'menuColor' => 'emerald',
            'menuTextColor' => 'text-emerald-800',
            ])->layout('layouts.app');
    }
    
}
