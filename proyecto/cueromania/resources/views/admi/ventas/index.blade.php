@extends('layouts.app')

@section('title', 'Lista de Ventas')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Lista de Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admi.ventas.create') }}" class="btn btn-primary mb-3">Nueva Venta</a>

    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_ventas }}</td>
                    <td>{{ $venta->fecha_ventas }}</td>
                    <td>{{ $venta->estado_venta }}</td>
                    <td>${{ number_format($venta->Total, 0, ',', '.') }}</td>
                    <td>{{ $venta->usuario ? $venta->usuario->primer_nombre : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admi.ventas.show', $venta) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admi.ventas.edit', $venta) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admi.ventas.destroy', $venta) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta venta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay ventas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

