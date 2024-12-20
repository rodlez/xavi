<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StorePortfolioFileRequest extends FormRequest
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
            'title' => 'bail|nullable|min:3|string',
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'title' => 'If there is a title must have at least :min characters',
                'description' => 'If there is a description must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                'title' => 'Si hay un título, debe tener al menos :min carácteres',
                'description' => 'Si hay una descripción, debe tener al menos :min carácteres',
            ];
        }
        if ($language == 'ca') {
            return [
                'title' => 'Si hi ha un títol, ha de tenir al menys :min caràcters',
                'description' => 'Si hi ha una descripció, ha de tenir al menys :min caràcters',
            ];
        }
    }
}
