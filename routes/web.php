<?php

use App\Http\Controllers\AdquirirServicioController;
use App\Http\Controllers\NotificacionContactoController;
use App\Http\Controllers\Public\CarritoController;
use App\Http\Controllers\Public\InicioController;
use App\Http\Controllers\Public\PlanController;
use App\Http\Controllers\Public\ReporteCreditoController;
use App\Http\Controllers\Public\ServicioController;
use App\Http\Controllers\Public\SolucionesEmpresasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Adquirir servicio mediante formulario
Route::resource('/adquirir-servicio', AdquirirServicioController::class)->only(['index', 'store']);

// Verificacion de correo
// Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/politicas-privacidad', function () {
    return view('politicas/politicas_privacidad');
})->name('politicas-privacidad');

// Auth::routes(['verify' => true]);

Route::get('/soluciones-empresas', [SolucionesEmpresasController::class, 'index'])->name('soluciones-empresas');

// Inicio
Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Score crediticio
Route::view('/score-crediticio', 'score_crediticio.index')->name('score-crediticio');

// Mejoramiento
// Route::view('/mejoramiento', 'mejoramiento.index')->name('mejoramiento');
Route::get('mejoramiento', [PlanController::class, 'serviciosMejoramiento'])->name('mejoramiento');

// Reporte de credito
Route::get('/reporte-credito', [ReporteCreditoController::class, 'index'])->name('reporte-credito');

// Planes y precios
Route::resource('planes', PlanController::class)->only(['index'])->parameters(['planes' => 'plan']);


// Contacto
Route::view('/contacto', 'contacto.index')->name('contacto');
Route::post('notificaciones-contacto', [NotificacionContactoController::class, 'store'])->name('notificaciones-contacto.store');

// Ubícanos
Route::view('/ubicanos', 'ubicanos.index')->name('ubicanos');

// Servicios
Route::get('servicios', [ServicioController::class, 'index'])->name('public.servicios.index');
Route::get('servicios/todos', [ServicioController::class, 'todos'])->name('public.servicios.todos');
Route::get('servicios/{servicio}', [ServicioController::class, 'show'])->name('public.servicios.show');
Route::post('servicios', [ServicioController::class, 'store'])->name('public.servicios.store');
Route::get('pagar-servicio/{servicio}', [ServicioController::class, 'pagar']);
Route::get('servicios/ciudades/{id}', [ServicioController::class, 'getCiudades']);
Route::get('pagar-payphone', [ServicioController::class, 'pagarPayphone']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Carrito: productos
Route::get('/carrito/{servicio}', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
/*Route::get('/carrito', [CarritoController::class, 'obtenerCarrito'])->name('carrito');
Route::post('/carrito/agregar', [CarritoController::class, 'agregarCarrito'])->name('carrito.agregar');
Route::post('/carrito/finalizar-pedido', [CarritoController::class, 'finalizarPedido'])->name('carrito.finalizar_pedido');
Route::get('/carrito/linea-pedido/{linea_pedido}/delete', [CarritoController::class, 'eliminarLineaPedidoCarrito'])->name('carrito.eliminar_linea_pedido');
Route::get('carrito/pedido/{pedido}', [CarritoController::class, 'mostrarDetallesPedido'])->name('carrito.mostrar_detalles_pedido');*/

Route::view('/solicitud-credito', 'solicitud_credito.index')->name('solicitud_credito.index');
