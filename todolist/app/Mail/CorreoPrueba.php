<?php

namespace App\Mail;

use App\Models\Tarea;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoPrueba extends Mailable
{
    use Queueable, SerializesModels;

    public $tarea; // La tarea que se pasará al correo

    public function __construct(Tarea $tarea)
    {
        $this->tarea = $tarea; // Asignamos la tarea a la propiedad
    }

    public function build()
    {
        return $this->view('emails/notificacion')
            ->subject('Notificación de Tarea Pendiente');
    }

}
