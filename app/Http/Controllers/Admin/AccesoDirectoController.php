<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccesoDirectoRequest;
use App\Http\Resources\Admin\AccesoDirectoResource;
use App\Models\Admin\AccesoDirecto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Src\Config\RutasStorage;
use Src\Shared\EliminarImagen;
use Src\Shared\GuardarImagenIndividual;
use Src\Shared\Utils;
use Throwable;

class AccesoDirectoController extends Controller
{
    private string $entidad = 'Acceso directo';

    public function __construct()
    {
        /* $this->middleware('can:puede.ver.configuracion')->only('page');
        $this->middleware('can:puede.editar.configuracion')->only('store'); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $search = request('search');
        $query = AccesoDirecto::search($search)->get();
        return AccesoDirectoResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccesoDirectoRequest $request
     * @return JsonResponse
     */
    public function store(AccesoDirectoRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $datos = $request->validated();
            if ($datos['imagen']) $datos['imagen'] = (new GuardarImagenIndividual($datos['imagen'], RutasStorage::ACCESOS_DIRECTOS))->execute();
            $modelo = AccesoDirecto::create($datos);
            $modelo = new AccesoDirectoResource($modelo->refresh());
            $mensaje = Utils::obtenerMensaje($this->entidad, 'store');
            return response()->json(compact('mensaje', 'modelo'));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param AccesoDirecto $acceso_directo
     * @return JsonResponse
     */
    public function show(AccesoDirecto $acceso_directo)
    {
        $modelo = new AccesoDirectoResource($acceso_directo);
        return response()->json(compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccesoDirectoRequest $request
     * @param AccesoDirecto $acceso_directo
     * @return JsonResponse
     */
    public function update(AccesoDirectoRequest $request, AccesoDirecto $acceso_directo)
    {
        return DB::transaction(function () use ($request, $acceso_directo) {
            DB::beginTransaction();
            $datos = $request->validated();
            if ($datos['imagen'] && Utils::esBase64($datos['imagen'])) $datos['imagen'] = (new GuardarImagenIndividual($datos['imagen'], RutasStorage::ACCESOS_DIRECTOS))->execute();
            $acceso_directo->update($datos);
            $modelo = new AccesoDirectoResource($acceso_directo->refresh());
            $mensaje = Utils::obtenerMensaje($this->entidad, 'update');
            DB::commit();
            return response()->json(compact('mensaje', 'modelo'));
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AccesoDirecto $acceso_directo
     * @return JsonResponse
     */
    public function destroy(AccesoDirecto $acceso_directo)
    {
        return DB::transaction(function () use ($acceso_directo) {
            // Eliminar imagen asociada si existe
            if (!empty($acceso_directo->imagen)) {
                $ruta = str_replace('/storage', '/public', $acceso_directo->imagen);
                Storage::delete($ruta);
            }

            // Eliminar archivos relacionados si existen
            if ($acceso_directo->archivos()->exists()) {
                foreach ($acceso_directo->archivos as $archivo) {
                    $ruta = str_replace('/storage', '/public', $archivo->ruta);
                    Storage::delete($ruta); // Asumiendo que 'ruta' es la columna donde guardas el archivo
                }
                $acceso_directo->archivos()->delete();
            }

            // Eliminar el modelo principal
            $acceso_directo->delete();

            // Construir la respuesta
            $mensaje = Utils::obtenerMensaje($this->entidad, 'destroy');
            return response()->json(compact('mensaje'));
        });
    }

    public function indexFiles(Request $request, AccesoDirecto $acceso_directo)
    {
        try {
            // $results = $this->archivoService->listarArchivos($incidente);
            $results = $acceso_directo->indexFiles($request);
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
    public function storeFiles(Request $request, AccesoDirecto $acceso_directo)
    {
        try {
//            $modelo = $this->archivoService->guardarArchivo($incidente, $request['file'], RutasStorage::INCIDENTES->value, 'INCIDENTES');
            $acceso_directo->storeFiles($request, RutasStorage::ARCHIVOS_ACCESOS_DIRECTOS);
            $mensaje = 'Archivo subido correctamente';
            $modelo = $acceso_directo;
        } catch (\Exception $ex) {
            throw Utils::obtenerMensajeErrorLanzable($ex);
        }
        return response()->json(compact('mensaje', 'modelo'));
    }
}
