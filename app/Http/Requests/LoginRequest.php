<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiFormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo necesita ser una cadena',
            'email.email' => 'El correo no es válido.',
            'email.max' => 'El correo pasa el largo.',
            'password.required' => 'La contraseña es requerida.',
            'password.string' => 'La contraseña debe de ser una cadena.',
            'password.min' => 'La contraseña debe de tener un largo de 6 caracteres como mínimo.'
        ];
    }
}
