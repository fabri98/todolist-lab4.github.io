<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableroController extends Controller
{

    public function index()
    {
        $tableros = Tablero::where('id_user', Auth::id())->get();
        return view('tableros/tableros', compact('tableros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'descripcion' => 'nullable|string', // Asegúrate de validar la descripción
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes estar autenticado para crear un tablero.');
        }
        
        Tablero::create([
            'name' => $request->name,
            'id_user' => Auth::id(),
            'descripcion' => $request->descripcion, // Guarda la descripción aquí
        ]);

        return redirect()->route('tableros.index')->with('success', 'Tablero creado exitosamente.');
    }




    public function create()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Tablero $tablero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tablero $tablero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tablero $tablero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el tablero por ID
        $tablero = Tablero::with('listas')->findOrFail($id);

        // Elimina las listas asociadas
        foreach ($tablero->listas as $lista) {
            $lista->tareas()->delete(); // Eliminar tareas asociadas
            $lista->delete(); // Eliminar la lista
        }

        // Elimina el tablero
        $tablero->delete();

        // Redirige a la lista de tableros con un mensaje de éxito
        return redirect()->route('tableros.index')->with('success', 'Tablero eliminado correctamente.');
    }

}
