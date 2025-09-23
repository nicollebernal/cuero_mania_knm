@extends('layouts.app')
@section('title', 'Listado de Pagos')

@section('content')

<h1 class="h4 mb-3">Listado de Pagos</h1>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

<a href="{{ route('admi.pagos.create') }}" class="btn btn-success mb-3">
    Crear Pago
</a>

<table class="table table-striped table-hover table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>ID</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Método</th>
            <th>Opción</th>
            <th>Venta asociada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pagos as $pago)
        <tr class="text-center">
            <td>{{ $pago->id_pagos }}</td>
            <td>${{ number_format($pago->precio, 2) }}</td>
            <td>{{ $pago->estado_pago }}</td> <!-- Color eliminado -->
            <td>{{ $pago->metodo_pagos }}</td>
            <td>{{ $pago->opcion_pagos }}</td>
            <td>
                @if($pago->venta)
                    Venta #{{ $pago->venta->id_ventas }} - ${{ number_format($pago->venta->Total, 2) }}
                @else
                    N/A
                @endif
            </td>
            <td>
                <a href="{{ route('admi.pagos.edit', $pago->id_pagos) }}" class="btn btn-sm btn-warning">
                    Editar
                </a>

                <form action="{{ route('admi.pagos.destroy', $pago->id_pagos) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Deseas eliminar este pago?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center fw-bold">No hay pagos registrados</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection




