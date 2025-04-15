<?php

namespace Src\App\Notificaciones;

use App\Models\Sistema\Notificacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Src\Config\TiposNotificaciones;

class NotificacionService
{
    /**
     * La función "obtenerNotificacionesRol" recupera notificaciones en función del rol del usuario y
     * campos especificados.
     *
     * @param string $rol El parámetro "rol" representa el rol de un usuario. Puede tener valores como "bodega"
     * o "compras" que corresponden a roles específicos en el sistema.
     * recuperar de la base de datos. Es un parámetro opcional y se puede utilizar para limitar la
     * cantidad de datos devueltos en los resultados.
     *
     * @return Notificacion[] una lista de notificaciones.
     */
    public function obtenerNotificacionesRol(string $rol) // andrea uniformes - arma cristian sanchez - anular un egreso
    {
        return match ($rol) {
            User::ROL_ADMINISTRADOR => $this->obtenerNotificacionesRolAdministrador(),
            User::ROL_SUPER_ADMINISTRADOR => $this->obtenerNotificacionesRolSuperAdministrador(),
            User::ROL_CLIENTE => $this->obtenerNotificacionesRolCliente(),
            default => Notificacion::where('per_destinatario_id', auth()->user()->id)->filter()->orderBy('id', 'desc')->get(),
        };
    }

    private function obtenerNotificacionesRolAdministrador()
    {
        return Notificacion::where('per_destinatario_id', Auth::id())->orWhere('per_destinatario_id', null)->filter()->orderBy('id', 'desc')->limit(100)->get();
    }

    private function obtenerNotificacionesRolSuperAdministrador()
    {
        return Notificacion::where('per_destinatario_id', Auth::id())->orWhere('per_destinatario_id', null)->filter()->orderBy('id', 'desc')->limit(100)->get();
    }

    private function obtenerNotificacionesRolCliente()
    {
        $tipos_notificaciones = [TiposNotificaciones::NOVEDADES];
        return Notificacion::whereIn('tipo_notificacion', $tipos_notificaciones)->where('per_destinatario_id', Auth::id())->orWhere('per_destinatario_id', null)->filter()->orderBy('id', 'desc')->limit(100)->get();
    }
}
