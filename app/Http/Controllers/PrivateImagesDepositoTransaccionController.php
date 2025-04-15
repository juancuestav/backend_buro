<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PrivateImagesDepositoTransaccionController extends Controller
{
	public function __construct()
	{
		// $this->middleware('can:puede.ver.depositos-transferencias')->only(['comprobantes']);
	}

	public function comprobantes($imagen)
	{
		$ruta = "private/comprobantes/{$imagen}";

		if (Storage::exists($ruta)) {
			$path = storage_path('app/' . $ruta);

			$file = File::get($path);
			$type = File::mimeType($path);

			$response = Response::make($file, 200);
			$response->header("Content-Type", $type);
			return $response;
		}

		abort(404);
	}
}
