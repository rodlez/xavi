<?php

namespace App\Livewire\Languages;

use App\Http\Requests\Languages\StoreLanguagesRequest;
use App\Models\Languages;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Livewire\Component;

class LanguagesCreate extends Component
{
    public $name;
    public $code;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

    protected function rules(): array
    {
        return (new StoreLanguagesRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StoreLanguagesRequest())->messages();
    }

    public function save()
    {
        $formData = $this->validate();

        try {
            Languages::create($formData);
            return to_route('languages')->with('message', __('generic.language') . ' (' . $this->name . ') ' . __('generic.successCreate'));
        } catch (Exception $e) {
            return to_route('languages')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.language') . ' (' . $this->name . ') ' . __('generic.errorCreate'));
        }
    }

    public function render()
    {
        return view('livewire.languages.languages-create',[
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-violet-600',
            'textMenuHeader'        => 'hover:text-violet-800',
            'bgMenuColor'           => 'bg-violet-800',
            'bgInfoColor'           => 'bg-violet-100',
            'menuTextColor'         => 'text-violet-800',
            'focusColor'            => 'focus:ring-violet-500 focus:border-violet-500',
            ])->layout('layouts.app');
    }
}
