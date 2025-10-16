<?php

namespace App\Http\Controllers;

use App\Models\personalizacion;
use Illuminate\Http\Request;
use App\Models\UsuarioDAO;
use App\Models\genero;
use App\Models\marca;
use App\Models\color;
use App\Models\categoria;


class personalizacionController extends Controller
{
    /**
     */
    public function index()
    {
        $personalizaciones = Personalizacion::with(['usuario','categoria','color','marca','genero'])->get();
        return view('admi.personalizacion.index', compact('personalizaciones'));
    }

 
    
    public function create()
    {
        $usuarios = UsuarioDAO::all();
        $categorias = Categoria::all();
        $colores = Color::all();
        $marcas = Marca::all();
        $generos = Genero::all();

        return view('admi.personalizacion.create', compact('usuarios','categorias','colores','marcas','generos'));
        
    }

  
  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:50',
            'imagen_personalizacion' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'fecha_solicitud' => 'required|date',
            'id_usuario' => 'required|integer',
            'id_categoria' => 'required|integer',
            'id_color' => 'required|integer',
            'id_marca' => 'required|integer',
            'id_genero' => 'required|integer',
        ]);

        // Guardar imagen
        if ($request->hasFile('imagen_personalizacion')) {
            $path = $request->file('imagen_personalizacion')->store('personalizaciones', 'public');
            $validated['imagen_personalizacion'] = $path;
        }

        Personalizacion::create($validated);

        return redirect()->route('admi.personalizacion.index')->with('success', 'Personalización creada exitosamente');
    }

  
    public function show(personalizacion $personalizacion)
    {
        //
    }

    
    public function edit(personalizacion $personalizacion)
    {
        //
    }

    public function update(Request $request, personalizacion $personalizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\personalizacion  $personalizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(personalizacion $personalizacion)
    {
        //
    }
}
