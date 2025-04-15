<?php

namespace App\Http\Requests;

use App\Models\Servicio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ServicioRequest extends FormRequest
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
			'nombre' => 'required|string|unique:servicios',
			'descripcion' => 'required|string',
			'estado' => ['required', Rule::in(Servicio::ACTIVO, Servicio::BORRADOR)],
			'categoria' => 'nullable|numeric|integer',
			'precio_unitario' => 'required|numeric',
			'gravable' => 'required|boolean',
			'tipo_servicio' => 'required|string',
			'url_video' => 'nullable|string',
			'url_destino' => 'nullable|string',
			'url_paypal' => 'nullable|string',
		];

        // Log::channel('testing')->info('Log', ['GUardar servicio', $this]);

		if (in_array($this->method(), ['PUT', 'PATCH'])) {
			$servicio = $this->route()->parameter('servicio');

			$rules['nombre'] = [
				'required', 'string', Rule::unique('servicios')->ignore($servicio)
			];
		}

		return $rules;
	}
}
