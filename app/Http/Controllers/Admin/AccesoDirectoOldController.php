<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class AccesoDirectoOldController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('can:puede.ver.configuracion')->only('page');
		$this->middleware('can:puede.editar.configuracion')->only('store'); */
	}

	// Pagina Vue
	public function page()
	{
		$configuracion_actual = [
			'porcentaje_iva' => Config::get('buro.porcentaje_iva'),
			'admite_pago_efectivo' => Config::get('buro.admite_pago_efectivo'),
			'admite_pago_tarjeta' => Config::get('buro.admite_pago_tarjeta'),
			'admite_deposito_bancario' => Config::get('buro.admite_deposito_bancario'),
			'url_pago_tarjeta' => Config::get('buro.url_pago_tarjeta'),
			'numero_cuenta' => Config::get('buro.numero_cuenta'),
			'entidad_financiera' => Config::get('buro.entidad_financiera'),
			'propietario_cuenta' => Config::get('buro.propietario_cuenta'),
			'identificacion_propietario_cuenta' => Config::get('buro.identificacion_propietario_cuenta'),
			'numero_contacto' => Config::get('buro.numero_contacto'),
			'whatsapp' => Config::get('buro.whatsapp'),
			'facebook' => Config::get('buro.facebook'),
			'instagram' => Config::get('buro.instagram'),
			'twitter' => Config::get('buro.twitter'),
		];

		// $archivo = 'buro_accesos_directos.php';
		// $accesosDirectos = $this->getData(config_path() . '/' . $archivo);
		// fopen(config_path() . '/' . $archivo, 'w');



		// return Inertia::render('configuraciones/view/ConfiguracionPage.vue');
		return Inertia::render('consultar/view/ConsultarPage.vue'); //, compact('accesosDirectos'));
	}

	private function getData($file)
	{
		$data = file($file);
		$returnArray = array();
		foreach ($data as $line) {
			$explode = explode(": ", $line);
			$returnArray[$explode[0]] = $explode[1];
		}

		return $returnArray;
	}


	// Guardar cambios
	public function store(Request $request)
	{
		$archivo = 'buro_accesos_directos.php';

		if (!file_exists(config_path() . '/' . $archivo)) {
			fopen(config_path() . '/' . $archivo, 'w');
		}

		$file = fopen(config_path() . '/' . $archivo, 'w');
		fwrite($file, '<?php' . PHP_EOL);
		fwrite($file, 'return [' . PHP_EOL);

		foreach ($request->except(['_token']) as $key => $value) {
			if (is_null($value)) {
				fwrite($file, '\'' . $key . '\' => \'\',' . PHP_EOL);
			} else {
				fwrite($file, '\'' . $key . '\' => \'' . $value . '\' ,' . PHP_EOL);
			}
		}
		fwrite($file, '];' . PHP_EOL);
		fclose($file);

		return response()->json(['mensaje' => 'Accesos directos actualizados exitosamente!']);
	}
}
