<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tarea;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoPrueba;

class EnviarCorreoFechaLimite extends Command
{
    // El nombre y la firma del comando
    protected $signature = 'correo:fecha-limite';
    protected $description = 'Enviar correo cuando la fecha límite de una tarea llegue.';

    public function __construct()
    {
        parent::__construct();
    }

    // Lógica para enviar los correos
    public function handle()
    {

        $tareas = Tarea::where('fecha_limite', '<=', now())
                   ->where('estado', 'Pendiente')
                   ->get();

    foreach ($tareas as $tarea) {
        // Enviar correo con la tarea específica
        Mail::to('correo@ejemplo.com')->send(new CorreoPrueba($tarea));

        $this->info('Correo enviado para la tarea: ' . $tarea->id);
    }
    }
}
