<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiFormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe de ser una cadena de texto.',
            'name.max' => 'El nombre no debe ser tan largo.',
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo necesita ser una cadena',
            'email.email' => 'El correo no es válido.',
            'email.max' => 'El correo pasa el largo.',
            'email.unique' => 'El correo ya está en uso.',
            'password.required' =>'La contraseña es requerida.',
            'password.string' => 'La contraseña debe de ser una cadena.',
            'password.min'=>'La contraseña debe de tener un largo de 6 caracteres como mínimo.',
            'role.required' => 'El rol es requerido.',
            'role.string' => 'El rol tiene que ser una cadena.',            
        ];
    }
}
