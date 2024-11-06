<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlquilerAbonoUpdateRequest extends FormRequest
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
            'alquiler_id' => 'required|exists:alquileres,id',
            'monto_pagado' => 'required|integer|min:0',
            'metodo_de_pagos_id' => 'required|exists:metodo_de_pagos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'alquiler_id.required' => 'El campo alquiler es obligatorio.',
            'alquiler_id.exists' => 'El alquiler seleccionado no es válido.',

            'monto_pagado.required' => 'El campo monto es obligatorio.',
            'monto_pagado.integer' => 'El campo monto debe ser un número entero.',
            'monto_pagado.min' => 'El campo monto debe ser al menos 0.',
            'metodo_de_pagos_id.required' => 'El campo método de pago es obligatorio.',
            'metodo_de_pagos_id.exists' => 'El método de pago seleccionado no es válido.',
        ];
    }
}
