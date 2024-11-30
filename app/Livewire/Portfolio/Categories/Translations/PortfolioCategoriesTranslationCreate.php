<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PortfolioCategoriesTranslationCreate extends Component
{
    public PortfolioCategory $category;

    public $language_id;
    public $name;

    protected $rules = [
        'name'              => 'required|min:3',
        'language_id'       => 'required',        
    ];

    protected $messages = [              
        'name.required' => 'The name is required',
        'name.min' => 'The name must have at least 3 characters',
        'language_id.required' => 'The language is required',
    ];


    public function mount(PortfolioCategory $category)
    {
        $this->category = $category;
    }

    public function save(Request $request)
    {
        $validated = $this->validate();
        $validated['pf_cat_id'] = $this->category->id;

        // TODO: No insert the current cataegory id as pf_cat_id
        //$translate = PortfolioCategoryTranslation::create($validated);

        /* $translate = PortfolioCategoryTranslation::create([
            'caca' => $this->category->id,
            'lang_id' => $this->language_id,
            'name'  => $this->name,
        ]); */

        DB::table('pf_categories_trans')->insert([
            'pf_cat_id' => $this->category->id,
            'lang_id' => $this->language_id,
            'name'  => $this->name,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        
        return to_route('pf_categories.show', $this->category)/* ->with('message', 'category (' . $category->name . ') successfully created.') */;       
    }

    public function render()
    {

        $languages = Languages::all();

        return view('livewire.portfolio.categories.translations.portfolio-categories-translation-create', [
            'category'      => $this->category,
            'languages'     => $languages,
        ])->layout('layouts.app');
    }
}
