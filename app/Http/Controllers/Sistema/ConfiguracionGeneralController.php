<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\ConfiguracionGeneralRequest;
use App\Http\Resources\Sistema\ConfiguracionGeneralResource;
use App\Models\Sistema\ConfiguracionGeneral;
use Illuminate\Http\Request;
use Src\Config\RutasStorage;
use Src\Shared\GuardarImagenIndividual;
use Src\Shared\Utils;

class ConfiguracionGeneralController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $configuracion = ConfiguracionGeneral::first();
        $results = $configuracion ? ConfiguracionGeneralResource::collection([$configuracion]) : [];
        return response()->json(compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ConfiguracionGeneralRequest $request)
    {
        $datos = $request->validated();

        $configuracion = ConfiguracionGeneral::first();

        if ($configuracion) {

            $datos = $this->getDatos($datos);

            $configuracion->update($datos);
        } else {
            $datos = $this->getDatos($datos);
            ConfiguracionGeneral::create($datos);
        }

        $mensaje = 'Actualizado exitosamente!';

        return response()->json(compact('mensaje'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function guardarImagen($imagen, $nombre_predeterminado)
    {
        $timestamp = time();
        if ($imagen) {
            if (Utils::esBase64($imagen)) {
                $nombre = $timestamp . '_' . $nombre_predeterminado;
                return (new GuardarImagenIndividual($imagen, RutasStorage::CONFIGURACION_GENERAL, $nombre))->execute();
            } else {
                $componentesUrl = parse_url($imagen);
                return $componentesUrl['path'];
            }
        }
    }

    /**
     * @param $datos
     * @return mixed
     */
    public function getDatos($datos)
    {
        if ($datos['logo_claro']) $datos['logo_claro'] = $this->guardarImagen($datos['logo_claro'], 'logo_claro');
        if ($datos['logo_oscuro']) $datos['logo_oscuro'] = $this->guardarImagen($datos['logo_oscuro'], 'logo_oscuro');
        if ($datos['logo_marca_agua']) $datos['logo_marca_agua'] = $this->guardarImagen($datos['logo_marca_agua'], 'logo_marca_agua');
        return $datos;
    }
}
