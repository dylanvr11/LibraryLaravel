<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'number_id' => ['required', 'numeric', "unique:users,number_id,{$this->user->id}"],
            'email' => ['required', 'email', "unique:users,email,{$this->user->id}"],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.string' => 'El nombre no es valido.',

            'last_name.required' => 'El apellido es requerido.',
            'last_name.string' => 'El apellido no es valido.',

            'number_id.required' => 'El documento es requerido.',
            'number_id.string' => 'El documento no es un numero.',
            'number_id.unique' => 'El documento ya fue creado.',

            'email.required' => 'El documento es requerido.',
            'email.email' => 'El correo debe de ser valido.',
            'email.unique' => 'El correo ya fue creado.',

            'password.string' => 'La contraseña debe de ser valida.',
            'password.min' => 'La contraseña es muy corta (min 8)',
            'password.confirmed' => 'La contraseña no coincide',
        ];
    }
}
