<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiForRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'email.required' => 'El correo es obligatorio',
            'email.string' => 'El correo debe ser una cadena de texto',
            'email.email' => 'El correo debe ser un correo electrónico válido',
            'email.max' => 'El correo no puede superar los 255 caracteres',
            'email.unique' => 'El correo electrónico ya está en uso',
        ];
    }
}
