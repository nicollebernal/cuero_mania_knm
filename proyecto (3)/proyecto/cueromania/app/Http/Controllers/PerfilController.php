<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioDAO;

class PerfilController extends Controller
{
    public function editar()
    {
        $usuario = session('usuario');

        if (!$usuario) {
    return redirect()->route('login.form')->with('error', 'Por favor inicia sesión.');
}


        return view('perfil', compact('usuario'));
    }

    public function actualizar(Request $request)
    {
        $usuario = session('usuario');

        if (!$usuario) {
            return redirect()->route('login.form')->with('error', 'Por favor inicia sesión.');
        }

        // Obtener el usuario real desde la base de datos
        $usuarioDB = UsuarioDAO::find($usuario->id_usuario);

        if (!$usuarioDB) {
            return redirect()->route('perfil.edit')->with('error', 'Usuario no encontrado.');
        }

        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:20',
            'gmail' => 'required|email|unique:usuarios,gmail,' . $usuario->id_usuario . ',id_usuario',
            'clave' => 'nullable|string|min:6',
        ]);

        $usuarioDB->primer_nombre = $request->primer_nombre;
        $usuarioDB->segundo_nombre = $request->segundo_nombre;
        $usuarioDB->primer_apellido = $request->primer_apellido;
        $usuarioDB->segundo_apellido = $request->segundo_apellido;
        $usuarioDB->direccion = $request->direccion;
        $usuarioDB->contacto = $request->contacto;
        $usuarioDB->gmail = $request->gmail;

        if ($request->filled('clave')) {
            $usuarioDB->clave = Hash::make($request->clave);
        }

        $usuarioDB->save();

        // Actualiza la sesión con los nuevos datos
        session(['usuario' => $usuarioDB]);

        return redirect()->route('perfil.edit')->with('success', 'Datos actualizados correctamente.');
    }
}
