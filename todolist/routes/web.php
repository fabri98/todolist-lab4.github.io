<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableroController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\TareaController;

use App\Mail\CorreoPrueba;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'editarPerfil'])->name('perfil.editar');
    Route::put('/perfil', [ProfileController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::get('/', function () {
        return view('index');
    });

    // Tableros

    Route::get('/tablero/{id}', [TableroController::class, 'show'])->name('tableros.show');
    Route::post('/tableros', [TableroController::class, 'store'])->name('tableros.store');
    Route::resource('tableros', TableroController::class);
    // Listas y Tareas
    Route::resource('listas', ListaController::class);
    Route::resource('tareas', TareaController::class);
    Route::delete('/listas/{id}/eliminar', [ListaController::class, 'eliminarLista'])->name('lista.eliminar');
    

    // notificaciones
    Route::get('/prueba-correo', [EmailController::class, 'enviarCorreo']);

});

require __DIR__ . '/auth.php';
