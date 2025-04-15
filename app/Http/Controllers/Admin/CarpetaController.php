<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarpetaRequest;
use App\Models\Carpeta;
use App\Models\User;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
	/**
	 * Crear una carpeta
	 */
	public function store(CarpetaRequest $request)
	{
		$modelo = Carpeta::create($request->validated());
		return response()->json(['mensaje' => 'Carpeta creada exitosamente!', 'modelo' => $modelo]);
	}


	/**
	 * Cambiar nombre de carpeta
	 */
	public function update(Request $request, Carpeta $carpeta)
	{
		$request->validate([
			'nombre' => 'required|string|min:1'
		]);

		$carpeta->nombre = $request['nombre'];
		$carpeta->save();
		return response()->json(['nombre' => $request['nombre'], 'mensaje' => 'Nombre de carpeta actualizado exitosamente!']);
	}


	/**
	 * Eliminar carpeta
	 */
	public function destroy(Carpeta $carpeta)
	{
		$carpeta->delete();
		return response()->json(['mensaje' => 'Carpeta eliminada exitosamente!']);
	}


	/**
	 * Asignar un usuario como propietario
	 */
	public function asignarUsuario(Request $request, Carpeta $carpeta)
	{
		$request->validate([
			'usuario' => 'required|numeric|integer'
		]);

		$usuario = User::find($request['usuario']);

		if (!$usuario) {
			return response()->json(['mensaje' => 'El usuario no existe'], 422);
		}

		$carpeta->usuario = $request['usuario'];
		$carpeta->save();

		/*$carpeta->subcarpetas()->update(['usuario' => $request['usuario']]);*/
		$this->updateUsuario($carpeta, $request['usuario']);

		$usuario = $usuario->name . ' ' . $usuario->apellidos;
		return response()->json(['mensaje' => 'Usuario asignado exitosamente!', 'usuario' => $usuario]);
	}


	private function updateUsuario(Carpeta $carpeta, int $usuario)
	{
		$subcarpetas = $carpeta->subcarpetas;

		foreach ($subcarpetas as $subcarpeta) {
			$subcarpeta->update(['usuario' => $usuario]);

			if ($subcarpeta->subcarpetas) {
				$this->updateUsuario($subcarpeta, $usuario);
			}
		}
	}
}
