<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArchivoRequest;
use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Src\Shared\EliminarArchivo;
use Src\Shared\GuardarArchivo;
use Src\Config\RutasStorage;

class ArchivoController extends Controller
{
    /**
     * Subir archivos
     */
    public function store(ArchivoRequest $request)
    {
        if ($request->hasFile('file')) {
            $guardarArchivo = new GuardarArchivo($request, RutasStorage::GESTOR_ARCHIVOS);
            $guardarArchivo->execute();
        }
        return response()->json(['mensaje' => 'Archivo subido exitosamente!']);
    }


    /**
     * Cambiar nombre de archivo
     */
    public function update(Request $request, Archivo $archivo)
    {
        $request->validate([
            'nombre' => 'required|string|min:1'
        ]);

        $extension = explode('.', $archivo->nombre);
        $nuevoNombre = $request['nombre'] . '.' . end($extension);
        $archivo->nombre = $nuevoNombre;
        $archivo->save();
        return response()->json(['nombre' => $nuevoNombre, 'mensaje' => 'Nombre de archivo actualizado exitosamente!']);
    }


    /**
     * Eliminar archivo
     */
    /*public function destroy(Archivo $archivo)
    {
        $ruta = str_replace('/storage', '', $archivo->ruta);
        Storage::delete($ruta);

        $archivo->delete();
        return response()->json(['mensaje' => 'Archivo eliminado exitosamente!']);
    }*/

    public function destroy(Archivo $archivo)
    {
        $eliminar = new EliminarArchivo($archivo);
        $eliminar->execute();
        return response()->json(['mensaje' => 'Archivo eliminado exitosamente.']);
    }
}
