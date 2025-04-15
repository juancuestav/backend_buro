<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Ciudad;
use App\Models\LineaPedido;
use App\Models\Marketing;
use App\Models\Pedido;
use App\Models\Provincia;
use App\Models\Servicio;
use App\Models\Sistema\ConfiguracionGeneral;
use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('verified');
        $this->middleware('can:puede.ver.carrito')->only('obtenerCarrito');
        $this->middleware('can:puede.editar.carrito')->only('agregarCarrito');
    }

    // El cliente no requiere de un carrito
    public function index(Request $request)
    {
        /* $id = $request['servicio'];
        $servicio = Servicio::find($id);

        $tipos_identificaciones = TipoIdentificacion::all();
        $provincias = Provincia::all();
        $ciudades = Ciudad::all();

        $si_no_nose = ['', 'SI', 'NO', 'NO SE'];
        $si_no = ['', 'SI', 'NO'];

        if ($servicio) {
            return view('carrito.index', compact('servicio', 'si_no_nose', 'si_no', 'tipos_identificaciones', 'provincias', 'ciudades'));
        }

        abort(404); */
    }

    public function store(Request $request)
    {
        $id = $request['servicio'];
        $servicio = Servicio::find($id);

        $marketing_encontrado = Marketing::where('identificacion', $request['identificacion'])->first();
        $marketing = null;
        if (!$marketing_encontrado) {
            $marketing = Marketing::create($request->all());
        } else {
            $marketing = $marketing_encontrado;
        }

        $pedido = new Pedido();
        $pedido->fecha_emision = date('Y-m-d');
        $pedido->estado_pago = Pedido::PAGO_PENDIENTE;
        $pedido->subtotal = $servicio->precio_unitario;
        $pedido->iva = $servicio->iva;
        $pedido->total = $servicio->precio_unitario + $servicio->iva;
        $pedido->marketing = $marketing->id;
        $pedido->save();
    }

    // index
    public function obtenerCarrito()
    {
        $pedido = $this->obtenerPedidoUsuario();
        $lineas_pedido = $pedido->lineas_pedido;

        $pedido->refresh();
        $subtotal = $pedido->subtotal;
        $precio_envio = $pedido->precio_envio;
        $total = $pedido->total;

        return view('carrito.index', array_merge(compact('lineas_pedido', 'pedido'), ['subtotal' => $subtotal, 'total' => $total, 'precio_envio' => $precio_envio]));
    }


    public function obtenerPedidoUsuario()
    {
        $pedido = Pedido::where('fecha_emision', null)->where('usuario', Auth::id())->count();
        if ($pedido == 0) {
            $pedido = new Pedido();
            $pedido->usuario = Auth::id();
            $pedido->save();
        } else {
            $pedido = Pedido::where('fecha_emision', null)->where('usuario', Auth::id())->first();
        }
        return $pedido;
    }


    public function agregarCarrito(Request $request)
    {
        $producto_actual = Servicio::find($request['servicio']);
        $pedido = $this->obtenerPedidoUsuario();



        $producto_ya_agregado = LineaPedido::where('pedido', $pedido->id)->where('servicio', $producto_actual->id)->count();

        if ($producto_ya_agregado) {
            return response()->json(['mensaje' => 'Ya ha sido agregado al carrito!']);
        }

        $precio = $this->calcularPrecioLineaPedido($producto_actual);

        $linea_pedido = new LineaPedido();
        $linea_pedido->pedido = $pedido->id;
        $linea_pedido->servicio = $producto_actual->id;
        $linea_pedido->precio = $precio;
        $linea_pedido->save();

        // Calcular nuevos precios pedido
        $subtotal = round($pedido->obtenerSubtotal(), 2);
        $total = round($subtotal, 2);

        // Actualizar precios pedido
        $pedido->subtotal = $subtotal;
        $pedido->total = $total;

        $pedido->save();

        return response()->json(['mensaje' => 'Agregado al carrito exitosamente!']);
    }


    private function calcularPrecioLineaPedido(Servicio $servicio)
    {
        return round(($servicio->precio_unitario + $servicio->iva), 2);
    }


    public function eliminarLineaPedidoCarrito(LineaPedido $linea_pedido)
    {
        // Calcular nuevos precios pedido
        $linea_pedido->delete();

        $pedido = $linea_pedido->pedidos;

        $subtotal = round($pedido->obtenerSubtotal(), 2);
        $total = round($subtotal + $pedido->precio_envio, 2);

        // Actualizar precios pedido
        $pedido->subtotal = $subtotal;
        $pedido->total = $total;
        $pedido->save();

        return redirect()->route('carrito');
    }


    public function finalizarPedido(Request $request)
    {

        /* $request->validate([
			'metodo_pago' => ['required', Rule::in([Pedido::EFECTIVO, Pedido::DEPOSITO, Pedido::CREDITO])],
		]); */

        $pedido = $this->obtenerPedidoUsuario();

        if ($pedido->lineas_pedido->count() == 0) {
            return response()->json(['mensaje' => 'El carrito no puede estar vacío!'], 422);
        }

        // Actualizar campos para finalizar pedido
        $pedido->numero_orden = $this->obtenerNumeroOrden();
        $pedido->estado_pago = Pedido::PAGO_PENDIENTE;
        $pedido->iva = $this->calcularIvaPedido($pedido);

        $pedido->metodo_pago = $request['metodo_pago'];
        $pedido->comentario = $request['comentario'];
        $pedido->fecha_emision = date("Y-m-d");
        $pedido->save();

        // Notificar emails NO BORRAR
        // $this->notificarPedidoCliente($pedido);
        // $this->notificarPedidoEmpleados($pedido);
        return response()->json(['id_pedido' => $pedido->id]);
    }

    private function notificarPedidoCliente(Pedido $pedido)
    {
        // $correo = Auth::user()->email;
        // Mail::to($correo)->send(new PedidoMail($pedido));
    }

    private function notificarPedidoEmpleados(Pedido $pedido)
    {
        /* $empleados = User::permission('puede.recibir.notificaciones')->get();

		foreach ($empleados as $empleado) {
			Mail::to($empleado->email)->send(new AdministradorPedidoMail($pedido));
		} */
    }

    public function obtenerNumeroOrden()
    {
        $pedidos_realizados = Pedido::where('fecha_emision', '!=', null)->count();
        return $pedidos_realizados + 1;
    }

    private function calcularIvaPedido(Pedido $pedido)
    {
        $iva = 0;
        foreach ($pedido->lineas_pedido as $linea_pedido) {
            $iva += $linea_pedido->servicios->iva;
        }
        return round($iva, 2);
    }

    public function mostrarDetallesPedido(Request $request)
    {
        if ($request['pedido']) {
            $pedido = Pedido::find($request['pedido']);
            // return view('correos.administrador_nuevo_pedido', compact('pedido'));
            if ($pedido && $pedido->usuario == Auth::id())
                return $this->obtenerCorreoDetallesPedido($request['pedido']);
        }
    }

    private function obtenerCorreoDetallesPedido(int $id_pedido)
    {
        $pedido = Pedido::find($id_pedido);

        return view('correos.detalles_pedido', compact('pedido'));
    }
}
