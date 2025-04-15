<?php

namespace App\Http\Requests;

use App\Rules\Identificacion;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
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
		$tipo_identificacion = $this->get("tipo_identificacion");

		$rules = [
			'name' => ['required', 'string', 'max:255'],
			'apellidos' => ['nullable', 'string', 'max:255'],
			'celular' => ['required', 'max:10', new PhoneNumber()],
			'identificacion' => ['required', 'string', 'max:13', 'unique:users', new Identificacion(intval($tipo_identificacion))],
			'tipo_identificacion' => ['required', 'integer'],
			'edad' => ['nullable', 'numeric', 'integer'],
			'direccion' => ['nullable', 'string'],
			'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'rol' => ['required'],
			'limite_consultas' => 'nullable|numeric|integer',
		];

		if (in_array($this->method(), ['PUT', 'PATCH'])) {
			$usuario = $this->route()->parameter('usuario');

			$rules['identificacion'] = [
				'required', 'string', 'max:13', Rule::unique('users')->ignore($usuario), new Identificacion(intval($tipo_identificacion))
			];

			$rules['email'] = [
				'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario),
			];

			$rules['password'] = [
				'nullable', 'string', 'min:8', 'confirmed'
			];
		}

		return $rules;
	}
}
