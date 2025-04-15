<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Config\RutasStorage;
use Src\Shared\Utils;
use Throwable;

trait SubirArchivoTrait
{
    /**************************
     * Listar archivos subidos
     **************************/
    public function indexFiles(Request $request) //, Model $model)
    {
        try {
//            $results = $this->listarArchivos($model);
            return $this->listarArchivos($this);
        } catch (Exception $e) {
//            $mensaje = $e->getMessage();
            return $e; //response()->json(compact('mensaje'), 500);
        }
//        return response()->json(compact('results'));
    }

    /*******************
     * Guardar archivos
     *******************/
    public function storeFiles(Request $request, RutasStorage $ruta)
    {
        try {
//            Log::channel('testing')->info('Log', ['Store archivo', $this]);
//            Log::channel('testing')->info('Log', ['Store archivo', $request]);
            $modelo = $this->guardarArchivo($this, $request->file, $ruta->value . $this->user_id);
            $mensaje = 'Archivo subido correctamente';
//            Log::channel('testing')->info('Log', ['Store archivo', 'subido']);
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage() . '. ' . $ex->getLine();
            return response()->json(compact('mensaje'), 500);
        }
        return response()->json(compact('mensaje', 'modelo'), 200);
    }

    private function guardarArchivo(Model $entidad, UploadedFile $archivo, string $ruta)
    {
        try {
            DB::beginTransaction();
            self::crearDirectorioConPermisos($ruta);
//            Log::channel('testing')->info('Log', ['Ruta', $ruta]);

            // $path = $archivo->store($ruta);
            $nombreArchivo = preg_replace('/[^\w\-\.]/', '', $archivo->getClientOriginalName());
//            Log::channel('testing')->info('Log', ['Nombre archivo', $nombreArchivo]);
            $path = $archivo->storeAs($ruta, $nombreArchivo);
//            Log::channel('testing')->info('Log', ['Path', $path]);
            $ruta_relativa = Utils::obtenerRutaRelativaArchivo($path);
            $modelo = $entidad->archivos()->create([
                'nombre' => $archivo->getClientOriginalName(),
                'ruta' => $ruta_relativa,
                'tamanio_bytes' => filesize($archivo),
            ]);
            DB::commit();
            return $modelo;
        } catch (Throwable $th) {
            DB::rollBack();
            Log::channel('testing')->info('Log', ['Error en el guardar de Archivo Service', $th->getMessage(), $th->getCode(), $th->getLine()]);
            throw new Exception($th->getMessage() . '. [LINE CODE ERROR]: ' . $th->getLine(), $th->getCode());
        }
    }

    /**
     * @throws Exception
     */
    private function listarArchivos(Model $entidad)
    {
        $results = [];
        try {
            return $entidad->archivos; //()->get();
        } catch (Throwable $th) {
//            Log::channel('testing')->info('Log', ['Error en el listarArchivos de Archivo Service', $th->getMessage(), $th->getCode(), $th->getLine()]);
            throw new Exception($th->getMessage() . '. [LINE CODE ERROR]: ' . $th->getLine(), $th->getCode());
        }
    }

    private static function crearDirectorioConPermisos(string $ruta)
    {
        try {
            if (!Storage::exists($ruta)) {
                // Storage::makeDirectory($ruta, 0755, true); //esta linea en el servidor crea con 0700 en lugar de 0755, probaremos con mkdir
                // mkdir($ruta, 0755, true); // mkdir tampoco funcionó, se prueba con otro metodo
                // Storage::disk('local')->mkdir($ruta,0755,true);
                Storage::disk('local')->makeDirectory($ruta, 0755);
            }
        } catch (Exception $e) {
            Log::channel('testing')->info('Log', ['Erorr al crear el directorio:', $e->getMessage()]);
        }
    }
}
