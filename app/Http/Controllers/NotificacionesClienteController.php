<?php

namespace App\Http\Controllers;

use App\Events\Sistema\NotificacionClienteEvent;
use App\Http\Resources\NotificacionClienteResource;
use App\Models\NotificacionCliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Throwable;

class NotificacionesClienteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.ver.notificaciones_clientes')->only(['page', 'show']);
    }

    // Pagina Vue
    public function page()
    {
        return Inertia::render('notificacionesCliente/view/NotificacionClientePage.vue');
    }

    // Listar
    public function index()
    {
        $notificaciones = NotificacionClienteResource::collection(NotificacionCliente::all());
        return response()->json(['results' => $notificaciones]);
    }

    // Guardar

    /**
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);

        $mensaje = $request['mensaje'];

        $modelo = NotificacionCliente::create(['mensaje' => $mensaje]);

        // event(new NotificacionClienteEvent($modelo, Auth::id(), null));

        return response()->json(['mensaje' => 'Mensaje enviado exitosamente!', 'modelo' => new NotificacionClienteResource($modelo)]);
    }

    public function destroy(NotificacionCliente $notificaciones_cliente)
    {
        $notificaciones_cliente->delete();
        return response()->json(['mensaje' => 'Mensaje eliminado exitosamente!']);
    }
}
