<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
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
        $parametro = $this->route('categoria') ?? $this->route('marca') ?? $this->route('presentacione');
        $caracteristica = $parametro->caracteristica->id;
        return [
            'nombre' => 'required|string|max:60|unique:caracteristicas,nombre,'.$caracteristica,
            'descripcion' => 'nullable|max:255'
        ];
    }
}
