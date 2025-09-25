@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Lista de Personalizaciones</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admi.personalizacion.create') }}" class="btn btn-primary">
            Nueva Personalización
        </a>
    </div>

    <table class="table table-hover table-bordered shadow-sm align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario (ID - Nombre)</th>
                <th>Fecha Solicitud</th>
                <th>Categoría</th>
                <th>Color</th>
                <th>Marca</th>
                <th>Género</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($personalizaciones as $p)
                <tr>
                    <td>{{ $p->id_personalizacion }}</td>
                    <td>
                        {{ $p->usuario->id_usuario }} <br>
                        <small class="text-muted">
                            {{ $p->usuario->primer_nombre }} {{ $p->usuario->primer_apellido }}
                        </small>
                    </td>
                    <td>{{ $p->fecha_solicitud }}</td>
                    <td>{{ $p->categoria->nombre_categoria }}</td>
                    <td>{{ $p->color->nombre_color }}</td>
                    <td>{{ $p->marca->nombre_marca }}</td>
                    <td>{{ $p->genero->nombre_genero }}</td>
                    <td>{{ $p->descripcion }}</td>
                    <td>
                        @if($p->imagen_personalizacion)
                            <img src="{{ asset('storage/'.$p->imagen_personalizacion) }}" 
                                 alt="imagen" class="img-thumbnail" width="100">
                        @else
                            <span class="badge bg-secondary">Sin imagen</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admi.personalizacion.edit', $p->id_personalizacion) }}" 
                           class="btn btn-sm btn-warning">
                           ✏️ Editar
                        </a>

                        <form action="{{ route('admi.personalizacion.destroy', $p->id_personalizacion) }}" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta personalización?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">No hay personalizaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
