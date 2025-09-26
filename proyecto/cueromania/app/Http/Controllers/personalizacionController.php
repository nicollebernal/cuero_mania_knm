<?php

namespace App\Http\Controllers;

use App\Models\Personalizacion;
use Illuminate\Http\Request;
use App\Models\UsuarioDAO;
use App\Models\Genero;
use App\Models\Marca;
use App\Models\Color;
use App\Models\Categoria;

class PersonalizacionController extends Controller
{
    public function index()
    {
        $personalizaciones = Personalizacion::with(['usuario','categoria','color','marca','genero'])->get();
        return view('admi.personalizacion.index', compact('personalizaciones'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $colores    = Color::all();
        $marcas     = Marca::all();
        $generos    = Genero::all();

        return view('cliente.personalizacion.create', compact('categorias','colores','marcas','generos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:50',
            'imagen_personalizacion' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'fecha_solicitud' => 'required|date',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'id_categoria' => 'required|integer',
            'id_color' => 'required|integer',
            'id_marca' => 'required|integer',
            'id_genero' => 'required|integer',
        ]);

        if ($request->hasFile('imagen_personalizacion')) {
            $path = $request->file('imagen_personalizacion')->store('personalizaciones', 'public');
            $validated['imagen_personalizacion'] = $path;
        }

        Personalizacion::create($validated);

        return redirect()->route('cliente.dashboard')
            ->with('success', 'Tu personalización fue creada exitosamente');
    }

    public function edit(Personalizacion $personalizacion)
    {
        $usuarios   = UsuarioDAO::all();
        $categorias = Categoria::all();
        $colores    = Color::all();
        $marcas     = Marca::all();
        $generos    = Genero::all();

        return view('admi.personalizacion.edit', compact('personalizacion','usuarios','categorias','colores','marcas','generos'));
    }

    public function update(Request $request, Personalizacion $personalizacion)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:50',
            'imagen_personalizacion' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'fecha_solicitud' => 'required|date',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'id_categoria' => 'required|integer',
            'id_color' => 'required|integer',
            'id_marca' => 'required|integer',
            'id_genero' => 'required|integer',
        ]);

        if ($request->hasFile('imagen_personalizacion')) {
            $path = $request->file('imagen_personalizacion')->store('personalizaciones', 'public');
            $validated['imagen_personalizacion'] = $path;
        }

        $personalizacion->update($validated);

        return redirect()->route('admi.personalizacion.index')
            ->with('success', 'Personalización actualizada exitosamente');
    }

    public function destroy(Personalizacion $personalizacion)
    {
        $personalizacion->delete();
        return redirect()->route('admi.personalizacion.index')
            ->with('success', 'Personalización eliminada exitosamente');
    }
}
