@extends('layouts.app')
@section('title','Lista de Usuarios')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0"> Lista de Usuarios</h2>
        <a href="{{ route('admi.usuarios.create') }}" class="btn btn-primary fa fa-plus">
             Crear Usuario
        </a>
    </div>

    <table class="table table-hover table-bordered align-middle text-center shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Contacto</th>
                <th>Dirección</th>
                <th>Gmail</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id_usuario }}</td>
                    <td>{{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }}</td>
                    <td>{{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}</td>   
                    <td>{{ $usuario->contacto }}</td>
                    <td>{{ $usuario->direccion }}</td>  
                    <td>{{ $usuario->gmail }}</td>
                    <td>{{ $usuario->rol->nombre_rol }}</td>
                    <td class="text-end">
                        <a href="{{ route('admi.usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admi.usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
