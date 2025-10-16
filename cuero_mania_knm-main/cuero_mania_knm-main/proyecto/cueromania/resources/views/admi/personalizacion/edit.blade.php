@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Editar Personalización</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admi.personalizacion.update', $personalizacion->id_personalizacion) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control"
                   value="{{ old('descripcion', $personalizacion->descripcion) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_solicitud" class="form-label">Fecha Solicitud</label>
            <input type="date" name="fecha_solicitud" class="form-control"
                   value="{{ old('fecha_solicitud', $personalizacion->fecha_solicitud) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}"
                        {{ old('id_usuario', $personalizacion->id_usuario) == $usuario->id_usuario ? 'selected' : '' }}>
                        {{ $usuario->id_usuario }} - {{ $usuario->primer_nombre }} {{ $usuario->primer_apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}"
                        {{ old('id_categoria', $personalizacion->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_color" class="form-label">Color</label>
            <select name="id_color" class="form-control" required>
                @foreach($colores as $color)
                    <option value="{{ $color->id_color }}"
                        {{ old('id_color', $personalizacion->id_color) == $color->id_color ? 'selected' : '' }}>
                        {{ $color->nombre_color }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_marca" class="form-label">Marca</label>
            <select name="id_marca" class="form-control" required>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id_marca }}"
                        {{ old('id_marca', $personalizacion->id_marca) == $marca->id_marca ? 'selected' : '' }}>
                        {{ $marca->nombre_marca }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_genero" class="form-label">Género</label>
            <select name="id_genero" class="form-control" required>
                @foreach($generos as $genero)
                    <option value="{{ $genero->id_genero }}"
                        {{ old('id_genero', $personalizacion->id_genero) == $genero->id_genero ? 'selected' : '' }}>
                        {{ $genero->nombre_genero }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen_personalizacion" class="form-label">Imagen</label><br>
            @if($personalizacion->imagen_personalizacion)
                <img src="{{ asset('storage/'.$personalizacion->imagen_personalizacion) }}" 
                     alt="imagen actual" width="120" class="mb-2"><br>
            @endif
            <input type="file" name="imagen_personalizacion" class="form-control">
            <small class="text-muted">Si no deseas cambiar la imagen, deja este campo vacío.</small>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="{{ route('admi.personalizacion.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
