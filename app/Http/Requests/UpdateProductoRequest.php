<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
        $producto = $this->route('producto');
        return [
            'codigo'            => 'required|string|unique:productos,codigo,' . $producto->id . '|max:50',
            'nombre'            => 'required|string|unique:productos,nombre,' . $producto->id . '|max:80',
            'description'       => 'nullable|max:255',
            'img_path'          => 'nullable|image|mimes:png,jpg,jpeg|max:2024',
            'marca_id'          => 'required|integer|exists:marcas,id',
            'presentacione_id'  => 'required|integer|exists:presentaciones,id',
            'categorias'        => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'marca_id'          => 'marca',
            'presentacion_id'   => 'presentacion'
        ];
    }

    public function messages()
    {
        return [
            'codigo.required'   => 'Se necesita un campo codigo'
        ];
    }
}
