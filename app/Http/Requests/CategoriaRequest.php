<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		$rules = [
			'nombre' => 'required|string|unique:categorias',
			'orden' => 'required|numeric|integer',
		];

		if (in_array($this->method(), ['PUT', 'PATCH'])) {
			$categoria = $this->route()->parameter('categoria');
			$rules['nombre'] = ['required', Rule::unique('categorias')->ignore($categoria)];
		}

		return $rules;
	}
}
