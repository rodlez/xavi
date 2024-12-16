<?php

namespace App\Http\Requests\Files;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StoreFileRequest extends FormRequest
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
            'files' => 'array|min:1|max:3',
            //'files.*' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
            'files.*' => 'required|file|mimetypes:application/pdf,image/jpeg,image/png',
        ];
    }

    public function messages(): array
    {
        $language = App::currentLocale();

        if ($language == 'en') {
            return [
                'files.min' => 'Select at least 1 file to upload (maximum 3 files)',
                'files.max' => 'Limited to 3 files to upload',
                'files.*.required' => 'Select at least one file to upload',
                //'files.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
                'files.*.mimetypes' => 'At least one file do not belong to the allowed formats: PDF, JPG, JPEG, PNG',
            ];
        }
        if ($language == 'es') {
            return [
                'files.min' => 'Selecciona al menos 1 archivo (máximo 3 archivos)',
                'files.max' => 'El límite de archivos para subir es de 3',
                'files.*.required' => 'No has seleccionado ningún archivo para subir',
                //'files.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
                'files.*.mimetypes' => 'Al menos 1 de los archivos no pertenece a los formatos permitidos: PDF, JPG, JPEG, PNG',
            ];
        }
        if ($language == 'ca') {
            return [
                'files.min' => 'Selecciona al menys 1 arxiu (màxim 3 arxius)',
                'files.max' => "El límit d'arxius per pujar es de 3",
                'files.*.required' => 'No has seleccionat cap arxiu per pujar',
                //'files.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
                'files.*.mimetypes' => 'Al menys 1 dels arxius no pertany als formats permesos: PDF, JPG, JPEG, PNG',
            ];
        }
    }
}
