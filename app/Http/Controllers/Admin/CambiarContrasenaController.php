<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CambiarContrasenaController extends Controller
{
	public function page()
	{
		return Inertia::render('cambiarContrasena/view/CambiarContrasenaPage.vue');
	}

	public function store(Request $request)
	{
		$request->validate([
			'current_password' => 'required',
			'password' => 'required',
			'password_confirmation' => 'required',
		]);

		$current_password = $request['current_password'];
		$password = $request['password'];
		$password_confirmation = $request['password_confirmation'];

		$usuario = User::find(Auth::id());

		if (!Hash::check($current_password, $usuario->password)) {
			return response()->json(['errors' => ['Contraseña actual' => 'Las contraseña actual no coincide con la contraseña de usuario!']], 422);
		}

		if ($password != $password_confirmation) {
			return response()->json(['errors' => ['No coinciden' => 'Las nueva contraseña y la contraseña de confirmación no coinciden!']], 422);
		}

		$usuario->password = Hash::make($password);
		$usuario->save();

		return response()->json(['mensaje' => 'Contraseña cambiada exitosamente!']);
	}
}
