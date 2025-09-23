@extends('layouts.app')

@section('title', 'Nueva Venta')

@section('content')
<div class="container mt-4">
    <h2>Nueva Venta</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admi.ventas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="fecha_ventas" class="form-label">Fecha</label>
            <input type="date" name="fecha_ventas" class="form-control" value="{{ old('fecha_ventas') }}" required>
        </div>

        <div class="mb-3">
            <label for="estado_venta" class="form-label">Estado</label>
            <input type="text" name="estado_venta" class="form-control" value="{{ old('estado_venta') }}" required>
        </div>

        <div class="mb-3">
            <label for="Total" class="form-label">Total</label>
            <input type="number" name="Total" class="form-control" value="{{ old('Total') }}" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <input type="number" name="id_usuario" class="form-control" value="{{ old('id_usuario') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admi.ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

