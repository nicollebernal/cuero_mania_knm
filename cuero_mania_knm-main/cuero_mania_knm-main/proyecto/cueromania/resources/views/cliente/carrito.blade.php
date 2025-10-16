<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito</title>
</head>
<body>
<h1>Mi Carrito</h1>

@if(session('success'))
  <p style="color:green;">{{ session('success') }}</p>
@endif

@if(empty($carrito))
  <p>No hay productos en el carrito</p>
@else
  <table border="1" cellpadding="8">
    <tr>
      <th>ID Producto</th>
      <th>Cantidad</th>
      <th>Acciones</th>
    </tr>
    @foreach($carrito as $id => $item)
      <tr>
        <td>{{ $item['id_producto'] }}</td>
        <td>{{ $item['cantidad'] }}</td>
        <td>
          <form action="{{ route('carrito.eliminar', $id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto del carrito?')">
              @csrf
              @method('DELETE')
              <button type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
@endif

<a href="{{ url('/cliente/dashboard') }}">Volver a productos</a>
</body>
</html>
