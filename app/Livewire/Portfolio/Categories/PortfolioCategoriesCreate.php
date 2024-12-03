<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Portfolio\PortfolioCategory;
use Exception;
use Illuminate\Http\Request;
use Livewire\Component;

class PortfolioCategoriesCreate extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|min:3|unique:pf_categories,name',
        'description' => 'nullable|min:3',
    ];

    protected $messages = [
        'name.required' => 'The category name is required',
        'name.min' => 'The category name must have at least 3 characters',
        'name.unique' => 'This category is already created',
        'description.min' => 'If there is a description must have at least 3 characters',
    ];

    public function save(Request $request)
    {
        $validated = $this->validate();

        try {
            PortfolioCategory::create($validated);

            return to_route('pf_categories')->with('message', 'Category (' . $this->name . ') successfully created');
        } catch (Exception $e) {
            return to_route('pf_categories')->with('error', 'Error (' . $e->getCode() . ') Category (' . $this->name . ')  can not be created');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.categories.portfolio-categories-create')->layout('layouts.app');
    }
}
