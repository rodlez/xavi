<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class StorePFTypeRequest extends FormRequest
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
            'name' => 'bail|required|min:3|string|' . Rule::unique('pf_types')->ignore($this->type),
            'position' => 'bail|nullable|numeric|gt:0',
            'color' => 'bail|nullable|min:3|string',
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'name.required' => 'The type name is required',
                'name.min' => 'The type name must have at least :min characters',
                'name.unique' => 'This type is already created',
                'position' => 'Position must be a number',
                'position.gt' => 'Position must be a positive number',
                'color' => 'If there is a color must have at least :min characters',
                'description' => 'If there is a description must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                'name.required' => 'El nombre es obligatorio',
                'name.min' => 'El nombre debe tener al menos :min carácteres',
                'name.unique' => 'Este nombre ya ha sido creado',
                'position' => 'Posición debe ser un número',
                'position.gt' => 'Posición debe ser un número positivo',
                'color' => 'Si hay un color, debe tener al menos :min carácteres',
                'description' => 'Si hay una descripción, debe tener al menos :min carácteres',
            ];
        }
        if ($language == 'ca') {
            return [
                'name.required' => 'El nom es obligatori',
                'name.min' => 'El nom ha de tenir al menys :min caràcters',
                'name.unique' => 'Aquest nom ja ha estat creat',
                'position' => 'Posició ha de ser un número',
                'position.gt' => 'Posició ha de ser un número positiu',
                'color' => 'Si hi ha un color, ha de tenir al menys :min caràcters',
                'description' => 'Si hi ha una descripció, ha de tenir al menys :min caràcters',
            ];
        }
    }
}
