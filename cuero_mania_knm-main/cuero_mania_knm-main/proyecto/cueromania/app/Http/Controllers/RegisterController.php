<?php

namespace App\Http\Controllers;

use App\Models\UsuarioDAO;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.registro');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'id_usuario'        => 'required|integer|unique:usuarios,id_usuario',
            'primer_nombre'     => 'required|string|max:15',
            'segundo_nombre'    => 'nullable|string|max:15',
            'primer_apellido'   => 'required|string|max:17',
            'segundo_apellido'  => 'nullable|string|max:17',
            'direccion'         => 'required|string|max:50',
            'contacto'          => 'required|string|max:15',
            'gmail'             => 'required|email|max:30|unique:usuarios,gmail',
            'clave'             => 'required|string|min:6|confirmed',
        ]);

        $validated['id_rol'] = 1;

        $validated['clave'] = $request->clave;

        UsuarioDAO::create($validated);

        return redirect()->route('login.form')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
