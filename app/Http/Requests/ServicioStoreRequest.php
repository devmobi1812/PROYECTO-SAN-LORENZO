<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicioStoreRequest extends FormRequest
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
            "precio" => "required|integer",
            "turno_id" => "nullable|integer",
            "producto_id" => "required|integer"
        ];
    }
    public function messages(): array
    {
        return [
            "nombre.required" => "El campo nombre es obligatorio.",
            "nombre.max" => "El campo nombre no debe exceder los 100 caracteres.",

            "precio.required" => "El campo precio es obligatorio.",
            "precio.integer" => "El campo precio debe ser un número entero.",

            'turno_id.integer' => 'El campo turno debe ser un número entero.', 
            'turno_id.exists' => 'El turno seleccionado no es válido.', 

            'producto_id.required' => 'El campo producto es obligatorio.', 
            'producto_id.integer' => 'El campo producto debe ser un número entero.', 
            'producto_id.exists' => 'El producto seleccionado no es válido.'
        ];
    }

    
}
