@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nueva Personalización</h2>

    <form action="{{ route('personalizacion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="imagen_personalizacion">Imagen</label>
            <input type="file" name="imagen_personalizacion" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="fecha_solicitud">Fecha de Solicitud</label>
            <input type="date" name="fecha_solicitud" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario">Usuario</label>
            <select name="id_usuario" class="form-select">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->primer_nombre }} {{ $usuario->primer_apellido }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_categoria">Categoría</label>
            <select name="id_categoria" class="form-select">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_color">Color</label>
            <select name="id_color" class="form-select">
                @foreach($colores as $color)
                    <option value="{{ $color->id_color }}">{{ $color->nombre_color }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_marca">Marca</label>
            <select name="id_marca" class="form-select">
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_genero">Género</label>
            <select name="id_genero" class="form-select">
                @foreach($generos as $genero)
                    <option value="{{ $genero->id_genero }}">{{ $genero->nombre_genero }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
