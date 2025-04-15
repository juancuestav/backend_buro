<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('can:puede.ver.roles_permisos')->only(['index', 'page', 'show']);
		$this->middleware('can:puede.crear.roles_permisos')->only('store');
		$this->middleware('can:puede.editar.roles_permisos')->only('update');
		$this->middleware('can:puede.eliminar.roles_permisos')->only('destroy'); */
	}


	// Pagina Vue
	public function page()
	{
		return Inertia::render('roles/view/RolPage.vue');
	}


	// Listar
	public function index()
	{
		$results = Role::all()->map(fn ($rol) =>
		[
			'value' => $rol->id,
			'label' => $rol->name,
		]);

		return response()->json(compact('results'));
	}


	// Guardar
	public function store(Request $request)
	{
		Validator::make($request->all(), [
			'name' => 'required|string|max:50',
		]);

		$rol = Role::create(['name' => strtoupper($request['name'])]);

		$modelo =
			[
				'id' =>  $rol->id,
				'name' => $rol->name
			];
		return response()->json(['mensaje' => 'Registro guardado exitosamente!', 'modelo' => $modelo]);
	}


	// Consultar
	public function show(Request $request, Role $role)
	{
		return response()->json(['modelo' => $role]);
	}


	// Actualizar
	public function update(Request $request, Role $role)
	{
		$request->validate([
			'name' => 'required|string|max:50',
		]);

		$role->update(['name' => strtoupper($request['name'])]);

		$modelo =
			[
				'id' =>  $role->id,
				'name' => strtoupper($request['name'])
			];

		return response()->json(['mensaje' => 'Rol actualizado exitosamente! ', 'modelo' => $modelo]);
	}


	// Eliminar
	public function destroy(Role $role)
	{
		$usuarios = User::all();

		foreach ($usuarios as $usuario) {
			if ($usuario->hasAnyRole($role->name)) {
				return response()->json(['mensaje' => 'Este rol se está utilizando por al menos un usuario y no puede ser eliminado!'], 409);
			}
		}
		$role->delete();
		return response()->json(['mensaje' => 'Rol eliminado exitosamente!']);
	}
}
