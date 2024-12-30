<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlquilerAbonoRequest extends FormRequest
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
            'monto_pagado' => 'required|integer|min:0',
            'detalle' => 'nullable|string|max:100',
            'metodo_de_pagos_id' => 'required|exists:metodo_de_pagos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'monto_pagado.required' => 'El campo monto pagado es obligatorio.',
            'monto_pagado.integer' => 'El campo monto pagado debe ser un número entero.',
            'monto_pagado.min' => 'El campo monto pagado debe ser al menos 0.',
            
            'detalle.string' => 'El detalle debe ser una cadena de texto.',
            'detalle.max' => 'El detalle no puede tener más de 100 caracteres.',

            'metodo_de_pagos_id.required' => 'El campo método de pago es obligatorio.',
            'metodo_de_pagos_id.exists' => 'El método de pago seleccionado no es válido.',
        ];
    }
}
