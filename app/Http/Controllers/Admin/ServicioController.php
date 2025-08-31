<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicioRequest;
use App\Http\Resources\ServicioResource;
use App\Models\Categoria;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Src\App\Servicios\ActualizarImagenServicio;
use Src\App\Servicios\CalcularIva;
use Src\App\Servicios\GuardarImagenServicio;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:puede.ver.servicios')->only(['index', 'page']);
        $this->middleware('can:puede.crear.servicios')->only('store');
        $this->middleware('can:puede.editar.servicios')->only('update');
        $this->middleware('can:puede.eliminar.servicios')->only('destroy');
    }


    // Pagina Vue
    public function page()
    {
        $categorias = Categoria::all();
        return Inertia::render('servicios/view/ServicioPage.vue', compact('categorias'));
    }


    // Listar
    public function index(Request $request)
    {
        $results = ServicioResource::collection(Servicio::latest()->get());
        return response()->json(compact('results'));
    }


    // Guardar
    public function store(ServicioRequest $request)
    {
        $servicio = Servicio::create($request->validated());
        $servicio->iva = round((new CalcularIva($servicio))(), 2);
        $servicio->save();


        if (request()->has('imagen') && !is_null(request()->get('imagen'))) {
            $guardar_imagen = new GuardarImagenServicio($servicio, request()->get('imagen'));
            $guardar_imagen->execute();
        }

        return response()->json(['mensaje' => 'Servicio agregado exitosamente!', 'modelo' => new ServicioResource($servicio)]);
    }


    public function show(Servicio $servicio)
    {
        return response()->json(['modelo' => new ServicioResource($servicio)]);
    }


    // Editar
    public function update(ServicioRequest $request, Servicio $servicio)
    {
        $servicio->update($request->validated());
        $actualizar_imagen = new ActualizarImagenServicio($servicio, request()->get('imagen'));
        $actualizar_imagen->execute();

        $servicio->iva = (new CalcularIva($servicio))();
        $servicio->save();

        return response()->json(['mensaje' => 'Servicio actualizado exitosamente!', 'modelo' => new ServicioResource($servicio->refresh())]);
    }


    // Eliminar
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return response()->json(['mensaje' => 'Servicio eliminado exitosamente!']);
    }
}
