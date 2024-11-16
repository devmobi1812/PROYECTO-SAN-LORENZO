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
            /*"cliente_id" => "required|integer|exists:clientes,id", 
            "fecha" => "required|date",
            "servicios" => "required|array",
            'servicios.*.id' => 'nullable|integer|exists:servicios,id',
            'servicios.*.cantidad' => 'nullable|integer|min:1',
            'servicios.*.desde' => 'nullable|date_format:H:i',
            'servicios.*.hasta' => 'nullable|date_format:H:i'
            */
        ];
    }
    

}
