<?php

namespace App\Events\Sistema;

use App\Models\Reporte\ArchivoReporte;
use App\Models\Sistema\Notificacion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Src\Config\TiposNotificaciones;
use Throwable;

class ArchivoReporteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Notificacion $notificacion;
    public int $emisor;
    public int $destinatario;

    /**
     * Create a new event instance.
     *
     * @return void
     * @throws Throwable
     */
    public function __construct(ArchivoReporte $archivo, int $emisor, int $destinatario)
    {
        $this->emisor = $emisor;
        $this->destinatario = $destinatario;

        $ruta = '/archivos-reportes';
        $mensaje = 'Se le ha compartido un reporte.';

        $this->notificacion = Notificacion::crearNotificacion($archivo, TiposNotificaciones::ARCHIVO_REPORTE, $mensaje, $ruta, $emisor, $destinatario, false);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
        $canal = 'archivo-reporte-tracker-' . $this->destinatario;
        return new Channel($canal);
    }

    public function broadcastAs()
    {
        return 'archivo-reporte-event';

    }
}
