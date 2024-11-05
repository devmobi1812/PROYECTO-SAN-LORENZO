<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DescuentoStoreRequest extends FormRequest
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
            "cantidad" => "required|integer"
        ];
    }

    public function messages()
    {
        return [

            "nombre.required" => "El campo Nombre es obligatorio.",
            "nombre.string" => "El campo Nombre debe ser una cadena de texto.",
            "nombre.max" => "El campo Nombre no debe exceder los 100 caracteres.",

            "cantidad.required" => "El campo Cantidad es obligatorio.",
            "cantidad.integer" => "El campo Cantidad debe ser un número entero.",
            "cantidad.min_digits" => "El campo Cantidad debe tener al menos 1 caracter."
        ];
    }
}
