<?php

namespace App\Rules;

use App\Models\TipoIdentificacion;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Src\Shared\ValidarIdentificacion;

class Identificacion implements Rule
{
	public int $tipo_identificacion;
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct(int $tipoIdentificacion)
	{
		$this->tipo_identificacion = $tipoIdentificacion;
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$tipo_identificacion = TipoIdentificacion::find($this->tipo_identificacion)->descripcion;

		if ($tipo_identificacion == User::PASAPORTE) {
			return true;
		}

		// validacion identificacion
		$validador = new ValidarIdentificacion();

		if ($tipo_identificacion == User::CEDULA) {
			if (!$validador->validarCedula($value)) {
				return false;
			}
		}

		if ($tipo_identificacion == User::RUC) {
			$ruc_valido = $validador->validarRucPersonaNatural($value)
				|| $validador->validarRucSociedadPrivada($value)
				|| $validador->validarRucSociedadPublica($value);

			if (!$ruc_valido) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'El número de identificación no es correcto.';
	}
}
