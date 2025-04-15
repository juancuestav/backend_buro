<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ContactoNotification;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Events\NotificacionContactoEvent;

class NotificacionContactoController extends Controller
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


	// Listar las notificacion del usuario logueado
	public function index()
	{
		$results = User::find(Auth::id())->unreadNotifications;
		return response()->json(compact('results'));
	}


	/**
	 * Un usuario sin cuenta usa el formulario de contacto
	 */
	public function store(Request $request)
	{
		$request->validate([
			'nombre' => 'required|string|max:255',
			'apellidos' => 'required|string|max:255',
			'correo' => 'required|email',
			'celular' => ['required', new PhoneNumber()],
			'mensaje' => 'required|string',
		]);

		$nombre = $request['nombre'];
		$apellidos = $request['apellidos'];
		$correo = $request['correo'];
		$celular = $request['celular'];
		$mensaje = $request['mensaje'];

		$notificacion = compact('nombre', 'apellidos', 'correo', 'celular', 'mensaje');
		$data = array_merge($notificacion, ['created_at' => date('c')]);

		$this->notificarEmpleados($notificacion);
		$this->notificarAdministradores($notificacion);

		event(new NotificacionContactoEvent($data));

		return back()->with('status', 'Gracias por comunicarte con nosotros!');
	}


	/**
	 * Registra en la tabla notifications
	 */
	private function notificarEmpleados($data)
	{
		$empleados = User::permission('puede.recibir.notificaciones')->get();

		foreach ($empleados as $empleado) {
			$empleado->notify(new ContactoNotification($data));
		}
	}

	private function notificarAdministradores($data)
	{
		$administradores = User::role(User::ROL_ADMINISTRADOR)->get();

		foreach ($administradores as $administrador) {
			$administrador->notify(new ContactoNotification($data));
		}
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
