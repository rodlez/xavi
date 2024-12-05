<?php

namespace App\Http\Requests\Languages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class StoreLanguagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {        
        return [
            'name' => 'bail|required|min:3|string',
            //'code' => 'bail|required|min:2|string|' . Rule::unique('languages')->ignore($this),
            'code' => 'bail|required|min:2|string|' . Rule::unique('languages')->ignore($this->language),
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'name.required' => 'The language name is required',
                'name.min' => 'The language name must have at least :min characters',
                'code.required' => 'The code is required',
                'code.min' => 'The code must have at least :min characters',
                'code.unique' => 'This code is already created',
            ];
        }
        if ($language == 'es') {
            return [
                'name.required' => 'El idioma es obligatorio',
                'name.min' => 'El idioma debe tener al menos :min carácteres',
                'code.required' => 'El código es obligatorio',
                'code.min' => 'El código debe tener al menos :min carácteres',
                'code.unique' => 'Este código ya ha sido creado',
            ];
        }
        if ($language == 'ca') {
            return [
                'name.required' => "L'idioma es obligatori",
                'name.min' => "L'idioma ha de tenir al menys :min caràcters",
                'code.required' => 'El codi es obligatori',
                'code.min' => 'El codi ha de tenir al menys :min caràcters',
                'code.unique' => 'Aquest codi ja ha estat creat',
            ];
        }
    }
}
