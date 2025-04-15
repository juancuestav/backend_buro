<?php

namespace App\Models\Sistema;

use App\Models\User;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Src\Config\TiposNotificaciones;
use Throwable;

/**
 * @method static ignoreRequest(string[] $array)
 * @method static orWhere(string $string, $id)
 * @method static whereIn(string $string, array $tipos_notificaciones)
 * @method static where(string $string, $id)
 */
class Notificacion extends Model
{
    use HasFactory, Filterable;
    protected $table = 'sis_notificaciones';
    protected $fillable = [
        'mensaje',
        'link',
        'per_originador_id',
        'per_destinatario_id',
        'tipo_notificacion',
        'leida',
        'informativa',
    ];

    private static array $whiteListFilter = ['*'];

    /**
     * Relación uno a muchos(inversa).
     * Una persona puede ser originador de una notificacion a la vez.
     */
    public function originador()
    {
        return $this->belongsTo(User::class, 'per_originador_id', 'id');
    }

    /**
     * Relación uno a muchos(inversa).
     * Una persona puede ser destinatario de una notificacion a la vez.
     */
    public function destinatario()
    {
        return $this->belongsTo(User::class, 'per_destinatario_id', 'id');
    }

    //Relación polimorfica
    public function notificable()
    {
        return $this->morphTo();
    }

    /**
     * La función `crearNotificacion` crea una notificación con los parámetros dados y devuelve la
     * notificación creada.
     *
     * @param string $mensaje El parámetro "mensaje" es una cadena que representa el mensaje de la
     * notificación. Puede ser cualquier texto que desee mostrar en la notificación.
     * @param string $ruta El parámetro "ruta" representa el enlace o URL asociado a la notificación. Es el destino al
     * que se redirigirá al usuario cuando haga clic en la notificación.
     * @param string|TiposNotificaciones $tipo El parámetro "tipo" representa el tipo de notificación. Esto permite indicar
     * el tipo de icono a mostrarse en la notifcación.
     * @param int|null $originador El parámetro "originador" hace referencia al ID de la persona que envía la
     * notificación.
     * @param int|null $destinatario El parámetro "destinatario" se refiere al destinatario de la notificación.
     * Es el ID de la persona que recibirá la notificación.
     * @param mixed $entidad El parámetro "entidad" se refiere a una instancia de una clase de modelo que
     * tiene una relación con el modelo "Notificación". Esta relación permite la creación de una nueva
     * notificación asociada a la instancia del modelo "entidad".
     * @param boolean $informativa El parámetro "informativa" es un valor booleano que indica si la notificación
     * es informativa o no. Si se establece en verdadero, significa que la notificación es informativa
     * y no requiere ninguna acción por parte del destinatario. Si se establece en falso, significa que
     * la notificación requiere alguna acción o respuesta
     *
     * @return Notificacion $notificacion el objeto de notificación creado.
     * @throws Exception|Throwable
     * @throws Exception
     */
    public static function crearNotificacion(Model $entidad, string|TiposNotificaciones $tipo, string $mensaje, string $ruta, ?int $originador, ?int $destinatario, bool $informativa)
    {
        try {
            DB::beginTransaction();
            $notificacion = $entidad->notificaciones()->create([
                'mensaje' => $mensaje,
                'link' => $ruta,
                'per_originador_id' => $originador,
                'per_destinatario_id' => $destinatario,
                'tipo_notificacion' => $tipo,
                'informativa' => $informativa,
            ]);
            DB::commit();
            return $notificacion;
        } catch (Throwable $th) {
            DB::rollBack();
            throw new Exception($th->getMessage().'. [LINE CODE ERROR]: '.$th->getLine(). $th->getCode());
        }
    }
}
