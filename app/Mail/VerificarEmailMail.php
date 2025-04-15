<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificarEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->subject('Código de verificación')->view('correos.verificar_correo');
    }
}
