<?php

namespace App\Http\Controllers;

use App\Models\UsuarioDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

class UsuarioController extends Controller
{
    public function index()
    {
        // Traemos los usuarios con su rol
        $usuarios = UsuarioDAO::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'primer_nombre' => 'required|string|max:15',
            'segundo_nombre' => 'nullable|string|max:15',
            'primer_apellido' => 'required|string|max:17',
            'segundo_apellido' => 'nullable|string|max:17',
            'direccion' => 'required|string|max:25',
            'contacto' => 'required|string|max:10',
            'gmail' => 'required|email|max:30|unique:usuarios,gmail',
            'clave' => 'required|string|min:6|confirmed',
            'id_rol' => 'required|integer',
        ]);

        $validatedData['clave'] = Hash::make($validatedData['clave']);

        UsuarioDAO::create($validatedData);
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(UsuarioDAO $usuario)
    {
        // 👈 cambio: usamos $usuario, no $usuarioDAO
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id_usuario)
    {
        $usuario = UsuarioDAO::findOrFail($id_usuario);
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id_usuario)
    {
        $validatedData = $request->validate([
            'primer_nombre' => 'required|string|max:15',
            'segundo_nombre' => 'nullable|string|max:15',
            'primer_apellido' => 'required|string|max:17',
            'segundo_apellido' => 'nullable|string|max:17',
            'direccion' => 'required|string|max:25',
            'contacto' => 'required|string|max:10',
            'gmail' => 'required|email|max:30|unique:usuarios,gmail,' . $id_usuario . ',id_usuario',
            'clave' => 'nullable|string|min:6|confirmed',
            'id_rol' => 'required|integer',
        ]);

        $usuario = UsuarioDAO::findOrFail($id_usuario);
        $usuario->update($validatedData); // 👈 así sí

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id_usuario)
    {
        $usuario = UsuarioDAO::findOrFail($id_usuario);
        $usuario->delete(); // 
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}

