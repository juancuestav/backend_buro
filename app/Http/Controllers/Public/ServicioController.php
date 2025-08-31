<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Ciudad;
use App\Models\Marketing;
use App\Models\Pedido;
use App\Models\Provincia;
use App\Models\Servicio;
use App\Models\Sistema\ConfiguracionGeneral;
use App\Models\TipoIdentificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $categoria_seleccionada = $request['categoria'];
        $servicios = [];
        $configuracion_general = ConfiguracionGeneral::first();

        if ($categoria_seleccionada) {
            $servicios = Servicio::activo()->esServicio()->where('categoria', $categoria_seleccionada)->paginate(6);
        } else {
            $servicios = Servicio::activo()->esServicio()->paginate(6);
        }
        $categorias = Categoria::orderBy('orden')->get();

        return view('servicios.index', compact('servicios', 'categorias', 'categoria_seleccionada', 'configuracion_general'));
    }

    public function show(Request $request, Servicio $servicio)
    {
        // $id = $request['servicio'];
        // $servicio = Servicio::find($id);

        $tipos_identificaciones = TipoIdentificacion::all();
        $provincias = Provincia::all();
        // $ciudades = Ciudad::all();
        $ciudades = Ciudad::where('provincia', $provincias->first()->id)->get();
        // Log::channl('testing')->info('Log', ['ciudades', $ciudades]);

        $si_no_nose = ['', 'SI', 'NO', 'NO SE'];
        $si_no = ['', 'SI', 'NO'];

        if ($servicio) {
            return view('carrito.index', compact('servicio', 'si_no_nose', 'si_no', 'tipos_identificaciones', 'provincias', 'ciudades'));
        }

        abort(404);
        // return view('servicios.show', compact('servicio'));
    }

    public function getCiudades(Request $request, $id)
    {
        $ciudades = Ciudad::where('provincia', $id)->get();
        return response()->json($ciudades);
    }


    public function store(Request $request)
    {
        $id = $request['servicio'];
        $servicio = Servicio::find($id);

        // Preguntas
        $tiene_reporte = $request['tiene_reporte'];
        $conoce_puntaje = $request['conoce_puntaje'];
        $tiene_deudas = $request['tiene_deudas'];
        $es_cliente = $request['es_cliente'];

        // pendiente de corregir - 2025-04-20
        /* $marketing_encontrado = Marketing::where('identificacion', $request['identificacion'])->first();
        if (!$marketing_encontrado) {
            $marketing = Marketing::create($request->all());
            } else {
                $marketing = $marketing_encontrado;
        } */
        $user_found = User::where('identificacion', $request['identificacion'])->first();

        $pedido = new Pedido();
        $pedido->fecha_emision = date('Y-m-d');
        $pedido->estado_pago = Pedido::PAGO_PENDIENTE;
        $pedido->subtotal = $servicio->precio_unitario;
        $pedido->iva = $servicio->iva;
        $pedido->servicio = $servicio->id;
        $pedido->total = $servicio->precio_unitario + $servicio->iva;
        $pedido->marketing = null;
        $pedido->user_id = $user_found?->id;
        $pedido->tiene_reporte = $tiene_reporte;
        $pedido->conoce_puntaje = $conoce_puntaje;
        $pedido->tiene_deudas = $tiene_deudas;
        $pedido->es_cliente = $es_cliente;
        $pedido->save();

        session(['identificacion' => $request['identificacion']]);
        return redirect('pagar-servicio/' . $servicio->id);
        // return back()->with('status', 'Gracias por adquirir éste servicio!');
    }


    public function pagar($servicio)
    {
        $servicio = Servicio::find($servicio);
        $configuracion_general = ConfiguracionGeneral::first();

        if ($servicio) {
            return view('servicios.pagar_servicio', compact('servicio', 'configuracion_general'));
        }
        abort(404);
    }

    public function todos()
    {
        $categorias = Categoria::orderBy('orden')->get();
        $servicios = Servicio::activo()->esServicio()->get();
        $serviciosSinCategoria = $servicios->filter(fn($servicio) => is_null($servicio->categoria));

        $data = [];

        foreach ($categorias as $categoria) {
            $serviciosFiltrados = $servicios->filter(fn($servicio) => $servicio->categoria == $categoria->id);
            array_push($data, ['nombre_categoria' => $categoria->nombre, 'id_categoria' => $categoria->id, 'values' => [...$serviciosFiltrados]]);
        }

        if ($serviciosSinCategoria->count() > 0) {
            array_push($data, ['nombre_categoria' => 'Otros servicios', 'values' => [...$serviciosSinCategoria]]);
        }

        // Log::channel('testing')->info('Log', ['servicios', $servicios]);
        return response()->json(compact('data'));
    }

    public function pagarPayphone()
    {
        // Log::channel('testing')->info('Log', ['Results', 'payphone']);
        $archivo = 'contador_payphone.txt';
        $f = fopen($archivo, 'r');
        $contador = 0;
        if ($f) {
            $contador = fread($f, filesize($archivo));
            $contador = $contador + 1;
            fclose($f);
        }

        $f = fopen($archivo, 'w+');
        if ($f) {
            fwrite($f, $contador);
            fclose($f);
        }
        return $contador;
    }
}
