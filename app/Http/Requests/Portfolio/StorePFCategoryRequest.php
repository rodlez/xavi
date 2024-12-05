<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class StorePFCategoryRequest extends FormRequest
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
        //dd($this->id);
        return [
            'name' => 'bail|required|min:3|string|' . Rule::unique('pf_categories')->ignore($this->category),
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'name.required' => 'The category name is required',
                'name.min' => 'The category name must have at least :min characters',
                'name.unique' => 'This category is already created',
                'description' => 'If there is a description must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                'name.required' => 'El nombre es obligatorio',
                'name.min' => 'El nombre debe tener al menos :min carácteres',
                'name.unique' => 'Este nombre ya ha sido creado',
                'description' => 'Si hay una descripción, debe tener al menos :min carácteres',
            ];
        }
        if ($language == 'ca') {
            return [
                'name.required' => 'El nom es obligatori',
                'name.min' => 'El nom ha de tenir al menys :min caràcters',
                'name.unique' => 'Aquest nom ja ha estat creat',
                'description' => 'Si hi ha una descripció, ha de tenir al menys :min caràcters',
            ];
        }
    }
}
