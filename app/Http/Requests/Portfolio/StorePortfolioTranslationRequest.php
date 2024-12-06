<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StorePortfolioTranslationRequest extends FormRequest
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
           /*  'category_id' => 'bail|required',
            'type_id' => 'bail|required', */
            'title' => 'bail|required|min:3|string',
            'subtitle' => 'bail|nullable|min:3|string',
            'content' => 'bail|nullable|min:3|string',
            'year' => 'nullable|gte:2000',
            'location' => 'bail|nullable|min:3|string',
            'client' => 'bail|nullable|min:3|string',
            'project' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                /* 'category_id.required' => 'Select one category',
                'type_id.required' => 'Select one category', */
                'title.required' => 'The title is required',
                'title.min' => 'The title must have at least :min characters',
                'subtitle' => 'If there is a subtitle must have at least :min characters',
                'content' => 'If there is a content must have at least :min characters',
                'year' => 'If there is a year must be greater than :gte',
                'location' => 'If there is a location must have at least :min characters',
                'client' => 'If there is a client must have at least :min characters',
                'project' => 'If there is a project must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                /* 'category_id.required' => 'Selecciona una categoria',
                'type_id.required' => 'Selecciona un tipo', */
                'title.required' => 'El titulo es obligatorio',
                'title.min' => 'The titulo must have at least :min characters',
                'subtitle' => 'If there is a subtitle must have at least :min characters',
                'content' => 'If there is a content must have at least :min characters',
                'year' => 'If there is a year must be greater than :gte',
                'location' => 'If there is a location must have at least :min characters',
                'client' => 'If there is a client must have at least :min characters',
                'project' => 'If there is a project must have at least :min characters',
            ];
        }
        if ($language == 'ca') {
            return [
                /* 'category_id.required' => 'Selecciona una categoria',
                'type_id.required' => 'Selecciona un tipus', */
                'title.required' => 'El títol es obligatori',
                'title.min' => 'The title must have at least :min characters',
                'subtitle' => 'If there is a subtitle must have at least :min characters',
                'content' => 'If there is a content must have at least :min characters',
                'year' => 'If there is a year must be greater than :gte',
                'location' => 'If there is a location must have at least :min characters',
                'client' => 'If there is a client must have at least :min characters',
                'project' => 'If there is a project must have at least :min characters',
            ];
        }
    }
}
