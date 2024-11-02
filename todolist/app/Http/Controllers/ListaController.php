<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Tablero;
use Illuminate\Http\Request;

class ListaController extends Controller
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
    public function show(Lista $lista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lista $lista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lista $lista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lista $lista)
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'id_tablero' => 'required|exists:tableros,id',
        ]);

        Lista::create([
            'nombre' => $request->nombre,
            'id_tablero' => $request->id_tablero,
            'autor' => auth()->user()->name, // Asumiendo que tienes autenticación
        ]);

        return redirect()->back()->with('success', 'Lista creada correctamente.');
    }
}
