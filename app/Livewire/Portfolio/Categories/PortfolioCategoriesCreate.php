<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Portfolio\PortfolioCategory;
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
        'name.required' => 'The name is required',
        'name.min' => 'The name must have at least 2 characters',
        'name.unique' => 'The name for this category is already created',  
        'description.min' => 'The description must have at least 3 characters',
    ];
 
    public function save(Request $request)
    {
        $validated = $this->validate();

        $category = PortfolioCategory::create($validated);
        
        return to_route('pf_categories', $category)/* ->with('message', 'category (' . $category->name . ') successfully created.') */;       
    }

    public function render()
    {
        return view('livewire.portfolio.categories.portfolio-categories-create')->layout('layouts.app');
    }
}
