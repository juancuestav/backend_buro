<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Src\Config\RutasStorage;

class PrivateFilesController extends Controller
{
	public function __construct()
	{
		// $this->middleware('can:puede.ver.depositos-transferencias')->only(['comprobantes']);
	}

	public function descargarArchivo($archivo)
	{
		$ruta = RutasStorage::GESTOR_ARCHIVOS->value . '/' . $archivo;

		if (Storage::exists($ruta)) {
			$path = storage_path('app/' . $ruta);

			$file = File::get($path);
			$type = File::mimeType($path);

			$response = Response::make($file, 200);
			$response->header("Content-Type", $type);
			return $response;
			// return Storage::download($ruta);
		}

		abort(404);
	}
}
