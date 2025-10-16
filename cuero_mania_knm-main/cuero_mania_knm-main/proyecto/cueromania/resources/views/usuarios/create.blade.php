@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-center">Crear Usuario</h1>

    {{-- Mostrar errores de validación --}}
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
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="id_usuario" class="form-label">Documento</label>
                        <input type="text" class="form-control" id="id_usuario" name="id_usuario" value="{{ old('id_usuario') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="primer_nombre" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="primer_apellido" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" value="{{ old('contacto') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="gmail" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="gmail" name="gmail" value="{{ old('gmail') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="clave" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave" name="clave" required>
                    </div>

                    <div class="col-md-6">
                        <label for="clave_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="clave_confirmation" name="clave_confirmation" required>
                    </div>

                    <div class="col-md-6">
                        <label for="id_rol" class="form-label">Rol</label>
                        <select name="id_rol" id="id_rol" class="form-control" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id_rol }}">{{ $rol->nombre_rol }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


