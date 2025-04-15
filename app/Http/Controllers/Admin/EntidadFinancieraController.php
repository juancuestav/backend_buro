<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntidadFinanciera;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class EntidadFinancieraController extends Controller
{
	public function __construct()
	{
		$this->middleware('can:puede.ver.entidades_financieras')->only(['index', 'page', 'show']);
		$this->middleware('can:puede.crear.entidades_financieras')->only('store');
		$this->middleware('can:puede.editar.entidades_financieras')->only('update');
		$this->middleware('can:puede.eliminar.entidades_financieras')->only('destroy');
	}


	// Pagina Vue
	public function page()
	{
		return Inertia::render('entidadesFinancieras/view/EntidadFinancieraPage.vue');
	}


	// Listar
	public function index()
	{
		$results = EntidadFinanciera::all();
		return response()->json(compact('results'));
	}


	// Guardar
	public function store(Request $request)
	{
		$request->validate([
			'nombre' => 'required|string|max:255|unique:entidades_financieras',
			'tipo' => 'nullable|string',
		]);

		$nombre = strtoupper($request['nombre']);
		$tipo = $request['tipo'];

		$modelo = EntidadFinanciera::create(compact('nombre', 'tipo'));
		return response()->json(['mensaje' => 'Entidad financiera guardada exitosamente!', 'modelo' => $modelo]);
	}


	// Consultar
	public function show(Request $request, EntidadFinanciera $entidades_financiera)
	{
		return response()->json(['modelo' => $entidades_financiera]);
	}


	// Actualizar
	public function update(Request $request, EntidadFinanciera $entidades_financiera)
	{
		$request->validate([
			'nombre' => ['required', 'string', 'max:255', Rule::unique('entidades_financieras')->ignore($entidades_financiera)],
			'tipo' => 'nullable|string',
		]);

		$nombre = strtoupper($request['nombre']);
		$tipo = $request['tipo'];

		$entidades_financiera->update(compact('nombre', 'tipo'));
		$modelo = $entidades_financiera->refresh();

		return response()->json(['mensaje' => 'Entidad financiera actualizada exitosamente!', 'modelo' => $modelo]);
	}


	// Eliminar
	public function destroy(EntidadFinanciera $entidades_financiera)
	{
		$entidades_financiera->delete();
		return response()->json(['mensaje' => 'Entidad financiera eliminada exitosamente!']);
	}
}
