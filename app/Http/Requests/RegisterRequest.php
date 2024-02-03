<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'email', 'unique:users,email', 'max:60'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->symbols()->numbers()],
            'apellido_paterno' => ['required', 'max:60', 'string'],
            'apellido_materno' => ['required', 'max:60', 'string'],
            'usuario' => ['required', "min:3", "max:20", "regex:/^[a-z0-9-]+$/", "unique:users,usuario"],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El Nombre Es Obligatorio',
            'name.max' => 'El Nombre Debe de Ser De Maximo 60 Caracteres',
            'email.required' => 'El Correo Electronico Es Obligatorio',
            'email.email' => 'El Correo Electronico No Es Valido',
            'email.unique' => 'El Correo Electronico Ya Esta Enlazado a Una Cuenta',
            'email.max' => 'El Correo Electronico Debe de Ser De Maximo 60 Caracteres',
            'password.required' => 'La Contraseña Es Obligatoria',
            'password.confirmed' => 'Las Contraseñas No Coinciden',
            'password' => 'La Contraseña Debe Tener al Menos un Simbolo, un Numero y 8 Caracteres',
            'apellido_paterno.required' => 'El Apellido Paterno Es Obligatorio',
            'apellido_paterno.max' => 'El Apellido Paterno Debe de Ser De Maximo 60 Caracteres',
            'apellido_materno.required' => 'El Apellido Materno Es Obligatorio',
            'apellido_materno.max' => 'El Apellido Materno Debe de Ser De Maximo 60 Caracteres',
            'usuario.required' => 'El Usuario Es Obligatorio',
            'usuario.min' => 'El Usuario Debe de Ser de Minimo 3 Caracteres',
            'usuario.max' => 'El Usuario Debe de Ser de Maximo 20 Caracteres',
            'usuario.unique' => 'El Usuario Ya Esta Enlazado a Una Cuenta',
        ];
    }
}