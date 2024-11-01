<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableroController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\TareaController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return view('index');
    });

    // Tableros

    Route::get('/tableros', [TableroController::class, 'index'])->name('tableros.index');
    Route::post('/tableros', [TableroController::class, 'store'])->name('tableros.store');
    Route::resource('tableros', TableroController::class);
    // Listas y Tareas
    Route::resource('listas', ListaController::class);
    Route::resource('tareas', TareaController::class);
    

    // ejercicio de clase
    Route::get('/component-test', function () {
        return view('ejemplo-component');
    });
    
});

require __DIR__ . '/auth.php';
