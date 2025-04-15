<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Src\App\Notificaciones\NotificacionService;

class NotificacionController extends Controller
{
    private NotificacionService $servicio;
    public function __construct()
    {
        $this->servicio = new NotificacionService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $results = [];
         Log::channel('testing')->info('Log', ['Usuario', auth()->user()]);
        if (auth()->user()->hasRole(User::ROL_SUPER_ADMINISTRADOR)) {
            $results = $this->servicio->obtenerNotificacionesRol(User::ROL_SUPER_ADMINISTRADOR);
        } else if (auth()->user()->hasRole(User::ROL_ADMINISTRADOR)) {
            $results = $this->servicio->obtenerNotificacionesRol(User::ROL_ADMINISTRADOR);
        } else if (auth()->user()->hasRole(User::ROL_CLIENTE)) {
            $results = $this->servicio->obtenerNotificacionesRol(User::ROL_CLIENTE);
        }

        return response()->json(compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
