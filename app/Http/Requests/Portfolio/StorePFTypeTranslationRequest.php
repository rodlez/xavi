<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StorePFTypeTranslationRequest extends FormRequest
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
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'name.required' => 'The translation is required',
                'name.min' => 'The translation must have at least :min characters',
                'description' => 'If there is a description must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                'name.required' => 'La traducción es obligatoria',
                'name.min' => 'La traducción debe tener al menos :min carácteres',
                'description' => 'Si hay una descripción, debe tener al menos :min carácteres',
            ];
        }
        if ($language == 'ca') {
            return [
                'name.required' => 'La traducció es obligatoria',
                'name.min' => 'La traducció ha de tenir al menys :min caràcters',
                'description' => 'Si hi ha una descripció, ha de tenir al menys :min caràcters',
            ];
        }
    }
}
