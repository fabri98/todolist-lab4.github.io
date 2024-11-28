<?php

namespace App\Http\Controllers;

use App\Mail\CorreoPrueba;
use Mail;

class EmailController extends Controller
{
    public function enviarCorreo()
    {
        Mail::to('correo@ejemplo.com')->send(new CorreoPrueba());
        return "Correo enviado correctamente.";
    }
}
