<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoController extends Controller
{
    public function __construct()
	{
		/* $this->middleware('can:puede.ver.permisos')->only(['index', 'show']);
		$this->middleware('can:puede.editar.permisos')->only('update'); */
	}
	// Pagina Vue
	public function show(Request $request, int $permiso)
	{
		$rol = Role::find($permiso);
		$todos_permisos = Permission::all()->pluck('name');
		$id_rol = $rol->id;
		$permisos_actuales_rol = $rol->permissions->pluck('name')->toArray();
		return Inertia::render('roles/modules/permisos/view/PermisoPage.vue', compact('todos_permisos', 'permisos_actuales_rol', 'id_rol'));
	}


	// Listar
	public function index(Request $request)
	{
		if (!$request['rol']) {
			return response()->json(['mensaje' => 'Debe especificar el nombre de un rol'], 409);
		}

		$rol = Role::where('name', strtoupper($request['rol']))->first();
		$results = $rol->permissions->pluck('name');

		return response()->json(compact('results'));
	}


	// Modificar
	public function update(Request $request, Role $permiso)
	{
		$permisos = $request['permisos'];
		$rol = $permiso;
		$rol->syncPermissions($permisos);

		return response()->json(['mensaje' => 'los permisos se han actualizados exitosamente!']);
	}
}
