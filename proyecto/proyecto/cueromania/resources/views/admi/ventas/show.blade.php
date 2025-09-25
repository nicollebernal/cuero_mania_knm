@extends('layouts.app')

@section('title', 'Detalle Venta')

@section('content')
<div class="container mt-4">
    <h2>Detalle de la Venta</h2>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $venta->id_ventas }}</td></tr>
        <tr><th>Fecha</th><td>{{ $venta->fecha_ventas }}</td></tr>
        <tr><th>Estado</th><td>{{ $venta->estado_venta }}</td></tr>
        <tr><th>Total</th><td>${{ number_format($venta->Total, 0, ',', '.') }}</td></tr>
        <tr><th>Usuario</th>
            <td>{{ $venta->usuario ? $venta->usuario->primer_nombre . ' ' . $venta->usuario->primer_apellido : 'N/A' }}</td>
        </tr>
    </table>

    <a href="{{ route('admi.ventas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection

