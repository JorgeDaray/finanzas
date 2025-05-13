<?php

namespace App\Mail;

use App\Models\Transaccion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TransaccionNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $transaccion;

    /**
     * Crear una nueva instancia de mensaje.
     *
     * @param \App\Models\Transaccion $transaccion
     * @return void
     */
    public function __construct(Transaccion $transaccion)
    {
        $this->transaccion = $transaccion;
    }

    /**
     * Construir el mensaje del correo.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->subject('Notificación de Nueva Transacción')
                    ->view('emails.transaccion_notificacion');  // Vista del correo
    }
}
