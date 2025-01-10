<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StorePortfolioRequest extends FormRequest
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
            'published' => 'bail|nullable',
            'status' => 'bail|required',
            'position' => 'bail|nullable|numeric|gt:0',
            'name' => 'bail|required|min:3|string|' . Rule::unique('portfolios')->ignore($this->portfolio),
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'status.required' => 'Status is required',
                'position' => 'Position must be a number',
                'position.gt' => 'Position must be a positive number',
                'name.required' => 'The portfolio name is required',
                'name.min' => 'The portfolio name must have at least :min characters',
                'name.unique' => 'This portfolio is already created',
                'description' => 'If there is a description must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                'status.required' => 'Estado es obligatorio',
                'position' => 'Posición debe ser un número',
                'position.gt' => 'Posición debe ser un número positivo',
                'name.required' => 'El nombre es obligatorio',
                'name.min' => 'El nombre debe tener al menos :min carácteres',
                'name.unique' => 'Este nombre ya ha sido creado',
                'description' => 'Si hay una descripción, debe tener al menos :min carácteres',
            ];
        }
        if ($language == 'ca') {
            return [
                'status.required' => 'Estat es obligatori',
                'position' => 'Posició ha de ser un número',
                'position.gt' => 'Posició ha de ser un número positiu',
                'name.required' => 'El nom es obligatori',
                'name.min' => 'El nom ha de tenir al menys :min caràcters',
                'name.unique' => 'Aquest nom ja ha estat creat',
                'description' => 'Si hi ha una descripció, ha de tenir al menys :min caràcters',
            ];
        }
    }
}
