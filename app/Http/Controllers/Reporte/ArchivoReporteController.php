<?php

namespace App\Http\Controllers\Reporte;

use App\Events\Sistema\ArchivoReporteEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reporte\ArchivoReporteRequest;
use App\Http\Resources\Reporte\ArchivoReporteResource;
use App\Models\Admin\AccesoDirecto;
use App\Models\Reporte\ArchivoReporte;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Src\Config\RutasStorage;
use Src\Shared\Utils;
use Throwable;

class ArchivoReporteController extends Controller
{
    private $entidad = 'Archivo reporte';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $results = ArchivoReporteResource::collection(ArchivoReporte::ignoreRequest()->filter()->get());
        /* if (request('user_id')) {
            $results = ArchivoReporteResource::collection(ArchivoReporte::ignoreRequest()->filter()->get());
        } else if (request('identificacion')) {
            $user_id = User::where('identificacion', request('identificacion'))->first()?->id;
            $results = ArchivoReporteResource::collection(ArchivoReporte::ignoreRequest(['identificacion'])->filter()->where('user_id', $user_id)->get());
        } */
        return response()->json(compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArchivoReporteRequest $request
     * @return JsonResponse
     */
    public function store(ArchivoReporteRequest $request)
    {
        try {
            $datos = $request->validated();

            DB::beginTransaction();

            $modelo = ArchivoReporte::create($datos);
            // $modelo->storeFiles($request, RutasStorage::ARCHIVOS_REPORTES);$modelo->storeFiles($request, RutasStorage::ARCHIVOS_REPORTES);

            DB::commit();

            event(new ArchivoReporteEvent($modelo, Auth::id(), $modelo->user_id));

            $modelo = new ArchivoReporteResource($modelo);
            $mensaje = Utils::obtenerMensaje($this->entidad, 'store');

            return response()->json(compact('mensaje', 'modelo'));
        } catch (Exception|Throwable $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Ha ocurrido un error al insertar el registro de examen' . $e->getMessage() . ' ' . $e->getLine()], 422);
        }
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
    public function update(ArchivoReporteRequest $request, ArchivoReporte $archivo_reporte)
    {
        if ($request->isMethod('patch')) {
            $keysWithValues = array_filter($request->only($request->keys()), function ($value) {
                return !is_null($value);
            });

            // Remover la key 'id' si está presente
            unset($keysWithValues['id']);

            $archivo_reporte->update($keysWithValues);
            if ($request['titulo']) {
                $archivo = $archivo_reporte->archivos()->first();
                $nombre_anterior_archivo = $archivo->nombre;
                $nuevo_nombre = $this->renombrarArchivo($nombre_anterior_archivo, $request['titulo']);
                $archivo->update(['nombre' => $nuevo_nombre]);
            }
        }

        $modelo = new ArchivoReporteResource($archivo_reporte->refresh());
        $mensaje = Utils::obtenerMensaje($this->entidad, 'update');

        return response()->json(compact('mensaje', 'modelo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArchivoReporte $archivo_reporte)
    {
        $archivo = $archivo_reporte->archivos()->first();

        if ($archivo) {
            $ruta = str_replace('/storage', '/public', $archivo->ruta);
            Storage::delete($ruta);
            $archivo->delete();
        }

        $archivo_reporte->delete();

        $mensaje = Utils::obtenerMensaje($this->entidad, 'destroy');
        return response()->json(compact('mensaje'));
    }

    public function renombrarArchivo($nombre_anterior_archivo, $nuevo_nombre)
    {
        // Suponiendo que el nombre del archivo se recibe a través de la solicitud
        $filename = $nombre_anterior_archivo; // $request->input('filename'); // Ejemplo: 'imagen.jpg'

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return $nuevo_nombre . '.' . $extension; // response()->json(['extension' => $extension]);
    }

    public function indexFiles(Request $request, ArchivoReporte $archivo_reporte)
    {
        try {
            $results = $archivo_reporte->indexFiles($request);
        } catch (Throwable $th) {
            return $th;
        }
        return response()->json(compact('results'));
    }

    /**
     * Guardar archivos
     * @throws ValidationException|Throwable
     * @throws Throwable
     */
    public function storeFiles(Request $request, ArchivoReporte $archivo_reporte)
    {
        try {
            $archivo_reporte->storeFiles($request, RutasStorage::ARCHIVOS_REPORTES);
            $mensaje = 'Archivo subido correctamente';
            $modelo = $archivo_reporte;
        } catch (\Exception $ex) {
            throw Utils::obtenerMensajeErrorLanzable($ex);
        }
        return response()->json(compact('mensaje', 'modelo'));
    }
}
