<?php

namespace App\Http\Controllers;

use Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function editarPerfil(Request $request): View
    {
        return view('profile/edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function actualizarPerfil(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Confirmación de contraseña
        ]);

        $user = Auth::user();

        // Actualizar los campos del usuario
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Actualizar la contraseña si se ha proporcionado una nueva
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Guardar los cambios en la base de datos
        $user->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('perfil.editar')->with('success', 'Perfil actualizado correctamente.');
    }


}
