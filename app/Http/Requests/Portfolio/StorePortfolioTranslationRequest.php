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
            'pf_cat_trans_id' => 'bail|required',
            'pf_type_trans_id' => 'bail|required',
            'title' => 'bail|required|min:3|string',
            'subtitle' => 'bail|nullable|min:3|string',
            'content' => 'bail|nullable|min:3|string',
            'year' => 'nullable|gt:2000',
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
                'pf_cat_trans_id.required' => 'Select one category, if there is not one must be first created',
                'pf_type_trans_id.required' => 'Select one type, if there is not one must be first created',
                'title.required' => 'The title is required',
                'title.min' => 'The title must have at least :min characters',
                'subtitle' => 'If there is a subtitle must have at least :min characters',
                'content' => 'If there is a content must have at least :min characters',
                'year' => 'If there is a year must be greater than 2000',
                'location' => 'If there is a location must have at least :min characters',
                'client' => 'If there is a client must have at least :min characters',
                'project' => 'If there is a project must have at least :min characters',
            ];
        }
        if ($language == 'es') {
            return [
                'pf_cat_trans_id.required' => 'Selecciona una categoria, si no existe ninguna es necesario crearla',
                'pf_type_trans_id.required' => 'Selecciona un tipo, si no existe ninguno es necesario crearlo',
                'title.required' => 'El titulo es obligatorio',
                'title.min' => 'El título tiene que tener al menos :min carácteres',
                'subtitle' => 'Si hay un subtítulo, debe tener al menos :min caràcters',
                'content' => 'Si hay un contenido, debe tener al menos :min caràcters',
                'year' => 'Si hay un año, debe ser mayor que 2000',
                'location' => 'Si hay un localización, debe tener al menos :min caràcters',
                'client' => 'Si hay un cliente, debe tener al menos :min caràcters',
                'project' => 'Si hay un proyecto, debe tener al menos :min caràcters',
            ];
        }
        if ($language == 'ca') {
            return [
                'pf_cat_trans_id.required' => 'Selecciona una categoria, si no existeix cap es necesari crear-la',
                'pf_type_trans_id.required' => 'Selecciona un tipus, si no existeix cap es necesari crear-lo',
                'title.required' => 'El títol es obligatori',
                'title.min' => 'El títol ha de tenir al menys :min caràcters',
                'subtitle' => 'Si hi ha un subtítol, ha de tenir al menys :min caràcters',
                'content' => 'Si hi ha un contingut, ha de tenir al menys :min caràcters',
                'year' => 'Si hi ha un any, ha de ser més gran que 2000',
                'location' => 'Si hi ha una localització, ha de tenir al menys :min caràcters',
                'client' => 'Si hi ha un client, ha de tenir al menys :min caràcters',
                'project' => 'Si hi ha un projecte, ha de tenir al menys :min caràcters',
            ];
        }
    }
}
