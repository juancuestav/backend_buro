<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearStorageLinkController extends Controller
{
    public function __invoke()
	{
		if (file_exists(public_path('storage'))) {
			return 'El directorio "public/storage" ya existe.';
		}

		app('files')->link(storage_path('app/public'), public_path('storage'));

		// Ruta burocredito.ec
		$target = public_path('storage'); // laravel project
		// $shortcut = '/home/u849014422/public_html/storage'; // public cpanel
		$shortcut = '/home/u849014422/domains/burodecredito.ec/public_html/storage'; // public hostinger
		symlink($target, $shortcut);

		return 'El directorio "public/storage" ha sido creado.';
	}
}
