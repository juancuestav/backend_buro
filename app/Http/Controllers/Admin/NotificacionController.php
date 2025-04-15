<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificacionContactoEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ContactoNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class NotificacionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.recibir.notificaciones')->only(['index', 'page', 'show']);
    }

    // Pagina Vue
    public function page()
    {
        return Inertia::render('notificaciones/view/NotificacionPage.vue');
    }

    /**
     * Listrar
     */
    public function index(Request $request)
    {
        $results = [];

        if ($request['tipo'] == 'nuevos') {
            $results = $this->mapearNotificaciones(User::find(Auth::id())->unreadNotifications, 'NUEVO');
        } else if ($request['tipo'] == 'leidos') {
            $results = $this->mapearNotificaciones(DatabaseNotification::where('read_at', '!=', null)->get(), 'LEIDO'); //$this->mapearNotificaciones(DatabaseNotification::all());
        } else {
            $results = $this->mapearNotificaciones(User::find(Auth::id())->notifications, '');
        }
        return response()->json(compact('results'));
    }

    private function mapearNotificaciones($notificaciones, $estado)
    {
        return $notificaciones->map(fn ($notificacion) => [
            'id' => $notificacion->id,
            'cliente' => $notificacion->data['nombre'] . ' ' . $notificacion->data['apellidos'],
            'correo' => $notificacion->data['correo'],
            'tiempo'  => Carbon::parse($notificacion->created_at)->diffForHumans(),
            'estado' => $estado,
        ]);
    }

    public function show($notificacione)
    {
        $results = User::find(Auth::id())->notifications;
        $encontrado = $results->filter(fn ($item_notificacion) => $item_notificacion->id == $notificacione);
        return response()->json(['modelo' => $encontrado->first()]);
    }

    /**
     * Los usuarios con el permiso puede.recibir.notificaciones marcan su notificacion como leida
     */
    public function update(Request $request, $notificaciones_contacto)
    {
        User::find(Auth::id())->unreadNotifications()->where('id', $notificaciones_contacto)->first()->markAsRead();
        event(new NotificacionContactoEvent());
        return response()->json(['mensaje' => 'Marcado como léido exitosamente!']);
    }
}
