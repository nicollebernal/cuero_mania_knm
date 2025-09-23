@extends('layouts.app')
@section('title', isset($pago) ? 'Editar pago' : 'Crear pago')

@section('content')
<h1 class="h4 mb-3">{{ isset($pago) ? 'Editar pago' : 'Crear pago' }}</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($pago) ? route('admi.pagos.update', $pago->id_pagos) : route('admi.pagos.store') }}" method="POST">
    @csrf
    @if(isset($pago))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio"
               value="{{ old('precio', $pago->precio ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="estado_pago" class="form-label">Estado del pago</label>
        <input type="text" class="form-control" id="estado_pago" name="estado_pago"
               value="{{ old('estado_pago', $pago->estado_pago ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="metodo_pagos" class="form-label">Método de pago</label>
        <input type="text" class="form-control" id="metodo_pagos" name="metodo_pagos"
               value="{{ old('metodo_pagos', $pago->metodo_pagos ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="opcion_pagos" class="form-label">Opción de pago</label>
        <input type="text" class="form-control" id="opcion_pagos" name="opcion_pagos"
               value="{{ old('opcion_pagos', $pago->opcion_pagos ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="id_venta" class="form-label">Venta asociada</label>
        <select name="id_venta" id="id_venta" class="form-control" required>
            @foreach($ventas as $venta)
                <option value="{{ $venta->id_ventas }}"
                    {{ old('id_venta', $pago->id_venta ?? '') == $venta->id_ventas ? 'selected' : '' }}>
                    Venta #{{ $venta->id_ventas }} - Total ${{ number_format($venta->Total, 0) }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($pago) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('admi.pagos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
