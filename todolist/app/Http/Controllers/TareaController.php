<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
{
    // Validar que el estado sea uno de los valores permitidos
    $request->validate([
        'estado' => 'required|in:Pendiente,En Progreso,Finalizada',
    ]);

    // Actualizar el estado de la tarea
    $tarea->estado = $request->estado;
    $tarea->save();

    // Redirigir con un mensaje de éxito
    return back()->with('success', 'Estado de la tarea actualizado');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        // Eliminar la tarea de la base de datos
        $tarea->delete();
    
        // Redirigir con un mensaje de éxito
        return back()->with('success', 'Tarea eliminada');
    }
    
    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255', // Validar descripción
        'id_lista' => 'required|exists:listas,id',
        'fecha_limite' => 'nullable|date', // Valida que sea una fecha válida
        
    ]);

    Tarea::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'id_lista' => $request->id_lista,
        'fecha_limite' => $request->fecha_limite,
        'estado' => $request->estado,
    ]);

    return redirect()->back()->with('success', 'Tarea creada correctamente.');
}
}
