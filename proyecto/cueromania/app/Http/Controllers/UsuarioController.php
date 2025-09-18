<?php

namespace App\Http\Controllers;

use App\Models\UsuarioDAO;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = UsuarioDAO::all();
        return view('Interfaz.administrador.usuarios.index', compact('usuarios'));
        $usuarios = UsuarioDAO::with('rol')->get(); 
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $roles = Rol::all(); 
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'clave' => 'required|string|min:10|confirmed',
            'id_rol' => 'required|integer',
        ]);
        $validatedData['clave'] = Hash::make($validatedData['clave']);


        UsuarioDAO::create($validatedData);
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource
     */
    public function show(UsuarioDAO $usuarioDAO)
    {
        return view('usuarios.show', compact('usuarioDAO'));

    }

    
    public function edit(UsuarioDAO $usuarioDAO)
    {
        return view('usuarios.edit', compact('usuarioDAO'));

    }

    
    public function update(Request $request, UsuarioDAO $usuarioDAO)
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

        UsuarioDAO::update($validatedData);
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exito.');
    }

    /**
     * Remove the specified resource from storage.

     */
    public function destroy(UsuarioDAO $usuarioDAO)

    {
        UsuarioDAO::delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
