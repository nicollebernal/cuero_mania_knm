@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center text-danger">Crear Personalización</h2>

    {{-- Mostrar errores --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mostrar mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('cliente.personalizacion.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Documento</label>
            <input type="number" name="id_usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen_personalizacion" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha Solicitud</label>
            <input type="date" name="fecha_solicitud" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                @foreach($categorias as $c)
                    <option value="{{ $c->id_categoria }}">{{ $c->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select name="id_color" class="form-select" required>
                @foreach($colores as $c)
                    <option value="{{ $c->id_color }}">{{ $c->nombre_color }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="id_marca" class="form-select" required>
                @foreach($marcas as $m)
                    <option value="{{ $m->id_marca }}">{{ $m->nombre_marca }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Género</label>
            <select name="id_genero" class="form-select" required>
                @foreach($generos as $g)
                    <option value="{{ $g->id_genero }}">{{ $g->nombre_genero }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger">Guardar</button>
            <a href="{{ route('cliente.dashboard') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

