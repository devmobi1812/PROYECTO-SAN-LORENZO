<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoStoreRequest extends FormRequest
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

            "nombre" => "required|string|max:100",
            "desde" => "required|date_format:H:i",
            "hasta" => "required|date_format:H:i"
            
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres',

            'desde.required' => 'El campo desde es requerido',
            'desde.date_format' => 'El campo desde debe tener el formato correcto (HH:MM)',

            'hasta.required' => 'El campo hasta es requerido',
            'hasta.date_format' => 'El campo hasta debe tener el formato correcto (HH:MM)',


        ];
    }
}
