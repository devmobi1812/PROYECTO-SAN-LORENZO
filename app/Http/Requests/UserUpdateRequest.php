<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserUpdateRequest extends FormRequest
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
            "name" => "required|string",
            "email" => [
                "required",
                "string",
                Rule::unique("users")->ignore($this->route("id"))
            ],
            "password" => "string",
            "password2" => "string|same:password"
        ];
    }
    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            
            'password2.string' => 'La confirmación de contraseña debe ser una cadena de texto.',
            'password2.same' => 'La confirmación de contraseña debe coincidir con la contraseña.'
        ];
    }

}
