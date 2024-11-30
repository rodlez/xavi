<?php

namespace App\Livewire\Languages;

use App\Models\Languages;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Livewire\Component;

class LanguagesCreate extends Component
{
    public $name;
    public $code;

    protected $rules = [
        'name' => 'required|min:3',
        'code' => 'required|min:2|unique:languages,code',
    ];

    protected $messages = [              
        'name.required' => 'The name is required',
        'name.min' => 'The name must have at least 3 characters',
        'code.required' => 'The code is required',
        'code.min' => 'The code must have at least 2 characters',
        'code.unique' => 'The code for this language is already created',  
    ];
 
    public function save(Request $request)
    {
        $validated = $this->validate();

        //dd($validated);

        $language = Languages::create($validated);
        
        return to_route('languages', $language)->with('message', 'Language (' . $language->name . ') successfully created.');       
    }

    public function render()
    {
        return view('livewire.languages.languages-create')->layout('layouts.app');
    }
}
