<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlquilerReciboStoreRequest extends FormRequest
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
            "servicio_nombre" => "required|string|max:100",
            "servicio_precio" => "required|integer",
            "servicio_cantidad" => "required|integer",
            "servicio_deposito" => "required|integer"
       ];
    }

    public function messages(): array
    {
        return [
            "servicio_nombre.required" => "El nombre del servicio es obligatorio.",
            "servicio_nombre.string" => "El nombre del servicio debe ser una cadena de texto.",
            "servicio_nombre.max" => "El nombre del servicio no debe superar los 100 caracteres.",
            
            "servicio_precio.required" => "El precio del servicio es obligatorio.",
            "servicio_precio.integer" => "El precio debe ser un número entero.",
            
            "servicio_cantidad.required" => "La cantidad del servicio es obligatoria.",
            "servicio_cantidad.integer" => "La cantidad debe ser un número entero.",
            
            "servicio_deposito.required" => "El depósito del servicio es obligatorio.",
            "servicio_deposito.integer" => "El depósito debe ser un número entero."
        ];
    }
}
