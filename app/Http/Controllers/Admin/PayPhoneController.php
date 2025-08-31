<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPhoneController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Log para pruebas
        //Log::info('Webhook PayPhone recibido', $request->all());

        // Asegúrate de que la estructura coincida con lo que envía PayPhone
        $status = $request->input('status');
        $cedula = $request->input('document'); // <- normalmente aquí viene la cédula

        if (strtolower($status) === 'approved' && $cedula) {
            $usuario = User::where('identificacion', $cedula)->first();

            if ($usuario) {
                $usuario->activo = true;
                $usuario->save();

                //Log::info("Usuario {$usuario->name} activado correctamente.");
                // return response()->json(['success' => true]);
                return redirect()->route('carrito.congratulations');
            } else {
                Log::warning("No se encontró un usuario con cédula: $cedula");
            }
        }

        return response()->json(['success' => false], 400);
    }

    public function pagar(Request $request)
    {
        //Log::channel('testing')->info("Dentro de pagar: $request->all()");
        // Log::channel('testing')->info('Log', ['Results', $results]);
        $request->validate([
            'identificacion' => 'required|string',
            'servicio_id' => 'required|numeric|integer|exists:servicios,id',
        ]);

        // Si el usuario ya existe, redirige directo a la URL de pago según el plan
        if (User::where('identificacion', $request['identificacion'])->exists()) {
            $urlPagoPayphone = $request['tipo_tarjeta'] == 'internacional' ? Servicio::find($request['servicio_id'])->url_paypal : Servicio::find($request['servicio_id'])->url_destino;
            //Log::channel('testing')->info("url pago: $urlPagoPayphone");
            // return redirect($urlPagoPayphone);
            return response()->json([
                'redirect_url' => $urlPagoPayphone
            ]);
        }

        // Si no existe, redirige al SPA con el plan en query
        // return redirect("https://app.burodecredito.ec/register?servicio_id={$request->servicio_id}");
        return response()->json([
            'redirect_url' => env('SPA_URL') . "/register-pay?servicio_id={$request->servicio_id}"
        ]);
    }
}
