@extends('layouts.app')
@section('title', 'Editar Usuario')
@section('content')

<h1 class="h3 mb-4 text-center">Editar Usuario</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id_usuario" class="form-label">Documento</label>
                    <input type="text" class="form-control" id="id_usuario" name="id_usuario"
                           value="{{ old('id_usuario', $usuario->id_usuario) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="primer_nombre" class="form-label">Primer Nombre</label>
                    <input type="text" class="form-control" id="primer_nombre" name="primer_nombre"
                           value="{{ old('primer_nombre', $usuario->primer_nombre) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                    <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre"
                           value="{{ old('segundo_nombre', $usuario->segundo_nombre) }}">
                </div>

                <div class="col-md-6">
                    <label for="primer_apellido" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                           value="{{ old('primer_apellido', $usuario->primer_apellido) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                           value="{{ old('segundo_apellido', $usuario->segundo_apellido) }}">
                </div>

                <div class="col-md-6">
                    <label for="contacto" class="form-label">Contacto</label>
                    <input type="text" class="form-control" id="contacto" name="contacto"
                           value="{{ old('contacto', $usuario->contacto) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                           value="{{ old('direccion', $usuario->direccion) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="gmail" class="form-label">Gmail</label>
                    <input type="email" class="form-control" id="gmail" name="gmail"
                           value="{{ old('gmail', $usuario->gmail) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select class="form-select" id="id_rol" name="id_rol" required>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id_rol }}"
                                {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                                {{ $rol->nombre_rol }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
