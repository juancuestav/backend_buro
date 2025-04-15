<?php

namespace App\Listeners;

use App\Events\NotificacionContactoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificacionContactoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NotificacionContactoEvent  $event
     * @return void
     */
    public function handle(NotificacionContactoEvent $event)
    {
        //
    }
}
