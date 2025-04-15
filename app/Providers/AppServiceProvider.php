<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            // Comprobar si ya hemos marcado que la auditoría ha sido registrada
            if (Session::has('auditoria_registrada')) {
                // Si ya se ha registrado la auditoría, no registrar de nuevo
                return;
            }
            // Filtrar solo las consultas SELECT
            if (str_starts_with(strtoupper($query->sql), 'SELECT')) {
                // Obtener la conexión activa
                // $conexion = DB::getDefaultConnection(); // Obtiene la conexión activa
                $conexion = $query->connectionName;

                // Obtener el nombre de la tabla de la consulta (esto es básico, puede mejorar según lo necesites)
                preg_match('/from\s+"?(\w+)"?/i', $query->sql, $matches);
                $tabla = $matches[1] ?? 'desconocida';
                Log::channel('testing')->info('Log', ['R', $matches]);

                // Verificar si la consulta corresponde a alguna de las tablas y conexiones permitidas
                $permitido = false;
                if ($conexion === 'sqlite_banco' && $tabla === 'banco') {
                    $permitido = true;
                } elseif ($conexion === 'sqlite_ant' && $tabla === 'ant') {
                    $permitido = true;
                } elseif ($conexion === 'sqlite_iess' && $tabla === 'iess') {
                    $permitido = true;
                } elseif ($conexion === 'sqlite_registro_civil' && $tabla === 'registro_civil') {
                    $permitido = true;
                } elseif ($conexion === 'sqlite_sri' && $tabla === 'sri') {
                    $permitido = true;
                }

                // Si la consulta está permitida, registrar la auditoría
                if ($permitido) {
                    // Obtener el usuario autenticado
                    $usuarioId = Auth::check() ? Auth::id() : null;

                    // Registrar la IP del usuario
                    $ipUsuario = Request::ip();

                    // Obtener los parámetros de la consulta (si existen)
                    $parametros = implode(", ", $query->bindings);

                    // Registrar la auditoría en la base de datos
                    DB::table('auditoria_tablas_precalificacion')->insert([
                        'tabla' => $tabla,
                        'parametros' => $parametros,
                        'user_id' => $usuarioId,
                        'ip_usuario' => $ipUsuario,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
