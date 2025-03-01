<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlquilerUpdateRequest extends FormRequest
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
            'nombre_id' => 'required|exists:clientes,id',
            "fecha" => "required|date|after_or_equal:today",
            'descuento_id' => 'required|exists:descuentos,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre_id.required' => 'El campo cliente es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
           
        ];
    }
}
