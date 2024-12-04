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
            // TODO: Ignore current id in the unique validation - https://laravel-news.com/laravel-validation
            /* 'name' => 'bail|required|min:3|string|unique:pf_categories,name', */
            'name' => 'bail|required|min:3|string|' . Rule::unique('pf_types')->ignore($this->type),
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
         return [
            'name.required' => 'The type name is required',
            'name.min' => 'The type name must have at least :min characters',
            'name.unique' => 'This type is already created',
            'description' => 'If there is a description must have at least :min characters',
         ];
    }
}
