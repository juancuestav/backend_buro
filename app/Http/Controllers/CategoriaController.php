<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriaController extends Controller
{
	/* public function __construct()f
	{
		$this->middleware('can:puede.ver.categorias')->only(['index', 'listar', 'show']);
		$this->middleware('can:puede.crear.categorias')->only('store');
		$this->middleware('can:puede.editar.categorias')->only('update');
		$this->middleware('can:puede.eliminar.categorias')->only('destroy');
	} */


	// Pagina Vue
	public function page()
	{
		return Inertia::render('servicios/modules/categorias/view/CategoriaPage.vue');
	}


	// Listar
	public function index()
	{
		$results = CategoriaResource::collection(Categoria::orderBy('orden')->get());
		return response()->json(compact('results'));
	}


	// Guardar
	public function store(CategoriaRequest $request)
	{
		$categoria = Categoria::create($request->validated());
		return response()->json(['mensaje' => 'Categoría guardada exitosamente!', 'modelo' => new CategoriaResource($categoria)]);
	}


	// Consultar
	public function show(Request $request, Categoria $categoria)
	{
		return response()->json(['modelo' => new CategoriaResource($categoria)]);
	}


	// Actualizar
	public function update(CategoriaRequest $request, Categoria $categoria)
	{
		$categoria->update($request->validated());
		$categoria->refresh();
		return response()->json(['mensaje' => 'Categoría actualizada exitosamente!', 'modelo' => new CategoriaResource($categoria)]);
	}


	// Eliminar
	public function destroy(Categoria $categoria)
	{
		$categoria_utilizada = Servicio::where('categoria', $categoria->id)->count();

		if ($categoria_utilizada) {
			return response()->json(['mensaje' => 'Esta categoría no puede ser eliminada!'], 422);
		}

		$categoria->delete();
		return response()->json(['mensaje' => 'Categoría eliminada exitosamente!']);
	}
}
