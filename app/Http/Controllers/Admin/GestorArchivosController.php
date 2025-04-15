<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchivoResource;
use App\Http\Resources\CarpetaResource;
use App\Models\Archivo;
use App\Models\Carpeta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GestorArchivosController extends Controller
{
	// Pagina Vue
	public function page()
	{
		$archivos = [];
		$roles = User::rolesUsuarioActual();

		if (in_array(User::ROL_ADMINISTRADOR, $roles)) {
			$carpetas = CarpetaResource::collection(Carpeta::where('id_carpeta_padre', null)->get());
		} else {
			$carpetas = CarpetaResource::collection(Carpeta::where('id_carpeta_padre', null)->usuarioActual()->get());
		}

		return Inertia::render('gestorArchivos/GestorArchivosLayout.vue', compact('archivos', 'carpetas'));
	}


	/**
	 * Devuelve las subcarpetas y subarchivos del directorio especificado
	 */
	public function index(Request $request)
	{
		$idCarpetaActual = $request['carpeta'];
		$roles = User::rolesUsuarioActual();


		if (is_null($idCarpetaActual)) {
			if (in_array(User::ROL_ADMINISTRADOR, $roles)) {
				$subcarpetas = CarpetaResource::collection(Carpeta::raiz()->get());
			} else {
				$subcarpetas = CarpetaResource::collection(Carpeta::raiz()->usuarioActual()->get());
			}
			$subarchivos = [];
			$idCarpetaPadre = null;
		} else {
			$carpeta = Carpeta::find($idCarpetaActual);
			if (in_array(User::ROL_ADMINISTRADOR, $roles)) {
				$subcarpetas = CarpetaResource::collection($carpeta->subcarpetas);
			} else {
				$subcarpetas = CarpetaResource::collection($carpeta->subcarpetas()->usuarioActual()->get());
			}
			$subarchivos = ArchivoResource::collection($carpeta->archivos);
			$idCarpetaPadre = $carpeta->id_carpeta_padre;
		}

		return response()->json(compact('subcarpetas', 'subarchivos', 'idCarpetaPadre'));
	}

	/* private function getSubcarpetasOnlyOwner($idCarpetaActual, User $usuario)
	{
		if (is_null($idCarpetaActual)) {
			$subcarpetas = CarpetaResource::collection(Carpeta::raiz()->usuarioActual()->get());
			$subarchivos = [];
			$idCarpetaPadre = null;
		} else {
			$carpeta = Carpeta::find($idCarpetaActual);
			$subcarpetas = CarpetaResource::collection($carpeta->subcarpetas()->usuarioActual()->get());
			$subarchivos = ArchivoResource::collection($carpeta->archivos);
			$idCarpetaPadre = $carpeta->id_carpeta_padre;
		}
	} */
}
