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
            'nombre_id' => 'required|exists:clientes,id', // Verifica que el cliente exista en la tabla 'clientes'
            'fecha' => 'required|date', 
            'descuento_id' => 'nullable|exists:descuentos,id',
            'deposito' => 'required|numeric|min:0', 

           
            'servicio_cantidad' => 'nullable|integer|min:1', 
            'desde' => 'nullable|date_format:H:i', 
            'hasta' => 'nullable|date_format:H:i|after:desde', 

            'quincho' => 'nullable|boolean', 
            'vajilla' => 'nullable|boolean', 
            'pileta' => 'nullable|boolean', 
        ];
    }

    public function messages()
    {
        return [
            'nombre_id.required' => 'El campo cliente es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'servicio_cantidad.integer' => 'La cantidad del servicio debe ser un número entero.',
            'desde.date' => 'La fecha de inicio debe ser una fecha válida.',
            'hasta.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
           
        ];
    }
}
