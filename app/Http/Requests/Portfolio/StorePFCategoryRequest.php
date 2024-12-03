<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
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
        //dd($this->category);
        return [
            // TODO: Ignore current id in the unique validation - https://laravel-news.com/laravel-validation
            /* 'name' => 'bail|required|min:3|string|unique:pf_categories,name', */
            'name' => 'bail|required|min:3|string|'. Rule::unique('pf_categories')->ignore($this->category),
            'description' => 'bail|nullable|min:3|string',
        ];
    }

    public function messages(): array
    {
        //dd($this->category);
        return [
            'name.required' => 'The category name is required',
            'name.min' => 'The category name must have at least :min characters',
            'name.unique' => 'This category is already created',
            'description' => 'If there is a description must have at least :min characters',
        ];
    }
}
