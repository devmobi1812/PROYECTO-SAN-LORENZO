<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlquilerStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            "nombre_id" => "required|integer|exists:clientes,id", 
            "fecha" => "required|date|after_or_equal:today",
            "servicios" => "required|array",
            'servicios.*.id' => 'nullable|integer|exists:servicios,id',
            'servicios.*.cantidad' => 'nullable|integer|min:1',
            'servicios.*.desde' => 'nullable|date_format:H:i',
            'servicios.*.hasta' => 'nullable|date_format:H:i',
            'seña' => 'nullable|boolean',
            'metodo_de_pagos_id' => 'nullable|integer|required_if:seña,1|exists:metodo_de_pagos,id',
            'deposito' => 'required|integer|exists:depositos,id',
            'deposito_pago' => 'nullable|boolean',
            'metodo_de_pago_deposito' => 'nullable|integer|required_if:deposito_pago,1|exists:metodo_de_pagos,id',
            'descuento_id' => 'required|integer|exists:descuentos,id'

        ];
    }

    public function messages()
{
    return [
        // Validación para 'nombre_id'
        'nombre_id.required' => 'El campo "Cliente" es obligatorio.',
        'nombre_id.integer' => 'El campo "Cliente" debe ser un número válido.',
        'nombre_id.exists' => 'El cliente seleccionado no existe en nuestros registros.',

        // Validación para 'fecha'
        'fecha.required' => 'El campo "Fecha" es obligatorio.',
        'fecha.date' => 'El campo "Fecha" debe ser una fecha válida.',

        // Validación para 'servicios'
        'servicios.required' => 'Debes seleccionar al menos un servicio.',
        'servicios.array' => 'El campo "Servicios" debe ser una lista válida.',

        // Validaciones para elementos de 'servicios'
        'servicios.*.id.integer' => 'El ID de cada servicio debe ser un número válido.',
        'servicios.*.id.exists' => 'Uno o más servicios seleccionados no existen en nuestros registros.',
        'servicios.*.cantidad.integer' => 'La cantidad de cada servicio debe ser un número válido.',
        'servicios.*.cantidad.min' => 'La cantidad mínima para un servicio es 1.',
        'servicios.*.desde.date_format' => 'El campo "Desde" debe tener un formato válido de hora (HH:mm).',
        'servicios.*.hasta.date_format' => 'El campo "Hasta" debe tener un formato válido de hora (HH:mm).',

        // Validación para 'seña'
        'seña.boolean' => 'El campo "Seña" debe ser verdadero o falso.',

        // Validación para 'metodo_de_pagos_id'
        'metodo_de_pagos_id.integer' => 'El método de pago debe ser un número válido.',
        'metodo_de_pagos_id.exists' => 'El método de pago seleccionado no existe en nuestros registros.',
        'metodo_de_pagos_id.required_if' => 'El método de pago es obligatorio si el campo "Seña" está activado.',

        'metodo_de_pago_deposito.integer' => 'El método de pago debe ser un número válido.',
        'metodo_de_pago_deposito.exists' => 'El método de pago seleccionado no existe en nuestros registros.',
        'metodo_de_pago_deposito.required_if' => 'El método de pago es obligatorio si el campo "Pagar Depósito" está activado.',

    ];
}

    

}
