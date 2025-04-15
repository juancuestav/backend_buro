<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\PopupResource;
use App\Http\Resources\ServicioResource;
use App\Models\Popup;
use App\Models\Servicio;
use App\Models\Sistema\ConfiguracionGeneral;
use Illuminate\Http\Request;

class InicioController extends Controller
{
	public function index()
	{
		$popups = PopupResource::collection(Popup::all())->toArray($this);

		// Servicios
		// $servicios = Servicio::activo()->esServicio()->get();
		$servicios = Servicio::activo()->esServicio()->orderBy('categoria', 'desc')->get()->groupBy('categoria');
		// $servicios = $this->mapear($servicios);
		return view('inicio.index', compact('popups', 'servicios'));
	}

	private function mapear($listado) {
		return $listado->map(function($servicio) {
			$servicio->nombre_categoria = $servicio->categorias->nombre;
			return $servicio;
		});
	}

	/*private function mapearCategoria($listado) {
		return $listado->map(function($servicio) {
			return [
				'nombre_categoria' => $servicio->categorias->nombre,
				'servicios'
			];
		});
	}*/
}
