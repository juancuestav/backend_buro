<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopupRequest;
use App\Http\Resources\PopupResource;
use App\Models\Popup;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Src\App\Popup\ActualizarImagenPopup;
use Src\App\Popup\EliminarImagenPopup;
use Src\App\Popup\GuardarImagenPopup;

class PopupController extends Controller
{
	public function __construct()
	{
		$this->middleware('can:puede.ver.popup')->only(['index', 'page', 'show']);
		$this->middleware('can:puede.crear.popup')->only('store');
		$this->middleware('can:puede.editar.popup')->only('update');
		$this->middleware('can:puede.eliminar.popup')->only('destroy');
	}


	// Pagina Vue
	public function page()
	{
		return Inertia::render('popup/view/PopupPage.vue');
	}


	// Listar
	public function index()
	{
		$results = PopupResource::collection(Popup::all());
		return response()->json(compact('results'));
	}


	// Guardar
	public function store(PopupRequest $request)
	{
		$popup = Popup::create($request->all());

		if (!is_null($request['imagen'])) {
			$guardar_imagen_popup = new GuardarImagenPopup($popup, $request['imagen']);
			$guardar_imagen_popup->execute();
		}

		return response()->json(['mensaje' => 'Registro guardado exitosamente!', 'modelo' => new PopupResource($popup)]);
	}


	// Consultar
	public function show(Request $request, Popup $popup)
	{
		return response()->json(['modelo' => new PopupResource($popup)]);
	}


	// Editar
	public function update(PopupRequest $request, Popup $popup)
	{
		$actualizar_imagen_popup = new ActualizarImagenPopup($popup, $request['imagen']);
		$actualizar_imagen_popup->execute();

		$popup->update($request->validated());
		$popup->refresh();

		return response()->json(['modelo' => new PopupResource($popup), 'mensaje' => 'Registro actualizado correctamente!']);
	}


	// Eliminar
	public function destroy(Popup $popup)
	{
		$eliminar_imagen_popup = new EliminarImagenPopup($popup);
		$eliminar_imagen_popup->execute();

		$popup->delete();
	}
}
