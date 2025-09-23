@extends('layouts.app')

@section('title', 'Editar Venta')

@section('content')
<div class="container mt-4">
    <h2>Editar Venta</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admi.ventas.update', $venta) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fecha_ventas" class="form-label">Fecha</label>
            <input type="date" name="fecha_ventas" class="form-control" 
                   value="{{ old('fecha_ventas', $venta->fecha_ventas) }}" required>
        </div>

        <div class="mb-3">
            <label for="estado_venta" class="form-label">Estado</label>
            <input type="text" name="estado_venta" class="form-control" 
                   value="{{ old('estado_venta', $venta->estado_venta) }}" required>
        </div>

        <div class="mb-3">
            <label for="Total" class="form-label">Total</label>
            <input type="number" name="Total" class="form-control" 
                   value="{{ old('Total', $venta->Total) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <input type="number" name="id_usuario" class="form-control" 
                   value="{{ old('id_usuario', $venta->id_usuario) }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="{{ route('admi.ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection




