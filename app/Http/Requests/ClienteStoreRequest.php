<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
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
            "dni" => "required|integer|min_digits:7",
            "nombre" => "required|string|max:100",
            "domicilio" => "required|string|max:100",
            "contacto" => "required|string|max:100",
            "socio" => "boolean"
        ];
    }
    public function messages()
    {
        return [
            "dni.required" => "El campo DNI es obligatorio.",
            "dni.integer" => "El campo DNI debe ser un número entero.",
            "dni.min_digits" => "El campo DNI debe tener al menos 7 caracteres.",
            
            "nombre.required" => "El campo Nombre es obligatorio.",
            "nombre.string" => "El campo Nombre debe ser una cadena de texto.",
            "nombre.max" => "El campo Nombre no debe exceder los 100 caracteres.",
            
            "domicilio.required" => "El campo Domicilio es obligatorio.",
            "domicilio.string" => "El campo Domicilio debe ser una cadena de texto.",
            "domicilio.max" => "El campo Domicilio no debe exceder los 100 caracteres.",
            
            "contacto.required" => "El campo Contacto es obligatorio.",
            "contacto.string" => "El campo Contacto debe ser una cadena de texto.",
            "contacto.max" => "El campo Contacto no debe exceder los 100 caracteres.",
            
            "socio.required" => "El campo Socio es obligatorio.",
            "socio.boolean" => "El campo Socio debe ser verdadero o falso.",
        ];
    }
    
}
