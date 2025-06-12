<?php

namespace App\Http\Requests;

class UpdateProductRequest extends ApiForRequest
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
            'description' => 'required|max:2000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:category,id'
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "El nombre del producto es obligatorio",
            "description.required" => "La description es obligatoria",
            "price.required" => "El precio es obligatorio",
            "category_id.required" => "La categoria seleccionada no es valida"
        ];
    }


}
