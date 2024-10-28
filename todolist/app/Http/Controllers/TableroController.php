<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;

class TableroController extends Controller
{
    
    public function index()
    {
        $tableros = Tablero::all();
        return view('tableros/tableros', compact('tableros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tablero::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Tablero creado exitosamente!');
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
    public function destroy(Tablero $tablero)
    {
        //
    }
}
