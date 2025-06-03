<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends ApiFormRequest
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
            'description' => 'required|string|max:550',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => "Se necesita el campo nombre.",
            'name.string' => "El campo nombre debe de ser texto.",
            'name.max' => 'El campo del nombre excede lo largo',
            'description.string' => 'El campo descripción debe de ser texto.',
            'description.required' => 'Se necesita el campo descripción.',
            'stock.required' => 'Se necesita el campo stock.',
            'stock.integer' => 'El campo stock necesita ser un número entero',
            'category_id.required' => 'Se necesita el campo id de categoría',
            'category_id.exists' => 'La categoría no existe.',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe de ser un dato numerico'
        ];
    }

}
