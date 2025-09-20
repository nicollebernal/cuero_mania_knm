@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Personalizaciones</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('personalizacion.create') }}" class="btn btn-primary mb-3">Nueva Personalización</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Fecha Solicitud</th>
                <th>Usuario (ID - Nombre)</th>
                <th>Categoría</th>
                <th>Color</th>
                <th>Marca</th>
                <th>Género</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personalizaciones as $p)
                <tr>
                    <td>{{ $p->id_personalizacion }}</td>
                    <td>{{ $p->descripcion }}</td>
                    <td>
                        @if($p->imagen_personalizacion)
                            <img src="{{ asset('storage/'.$p->imagen_personalizacion) }}" alt="imagen" width="80">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $p->fecha_solicitud }}</td>
                    <td>
                        {{ $p->usuario->id_usuario }} - 
                        {{ $p->usuario->primer_nombre }} {{ $p->usuario->primer_apellido }}
                    </td>
                    <td>{{ $p->categoria->nombre_categoria }}</td>
                    <td>{{ $p->color->nombre_color }}</td>
                    <td>{{ $p->marca->nombre_marca }}</td>
                    <td>{{ $p->genero->nombre_genero }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

