<?php

namespace App\Events\Sistema;

use App\Models\NotificacionCliente;
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

class NotificacionClienteEvent implements ShouldBroadcast
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
    public function __construct(NotificacionCliente $notificacion_cliente, int $emisor, int $destinatario)
    {
        $this->emisor = $emisor;
        $this->destinatario = $destinatario;

        $ruta = '/notificaciones-generales';
        $mensaje = $notificacion_cliente['mensaje'];

        $this->notificacion = Notificacion::crearNotificacion($notificacion_cliente, TiposNotificaciones::NOVEDADES, $mensaje, $ruta, $emisor, $destinatario, false);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        $canal = 'notificaciones-clientes-tracker';
        return new Channel($canal);
    }

    public function broadcastAs()
    {
        return 'notificaciones-clientes-event';
    }
}
