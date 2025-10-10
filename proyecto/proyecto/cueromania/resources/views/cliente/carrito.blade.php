<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito - Curomania</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
    <style>
        /* === Estilos adicionales solo para el carrito === */

        body {
            background: linear-gradient(135deg, #8d1b2e, #5a0f1b, #570a18);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }

        .carrito-container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0,0,0,0.25);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            text-align: center;
            color: #8d1b2e;
            margin-bottom: 30px;
            font-size: 28px;
            letter-spacing: 1px;
        }

        .mensaje {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .mensaje.success {
            color: green;
        }

        .mensaje.error {
            color: #b32424;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #8d1b2e;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 15px;
            color: #333;
        }

        tr:hover {
            background-color: #f8f8f8;
        }

        button {
            background-color: #8d1b2e;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #b32424;
            transform: scale(1.05);
        }

        .btn-volver {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #8d1b2e;
            color: white;
            padding: 10px 18px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-volver:hover {
            background-color: #b32424;
            transform: scale(1.05);
        }

        .vacio {
            text-align: center;
            color: #555;
            font-size: 18px;
        }

    </style>
</head>
<body>

<div class="carrito-container">
    <h1>🛒 Mi Carrito</h1>

    @if(session('success'))
        <p class="mensaje success">{{ session('success') }}</p>
    @endif

    @if(empty($carrito))
        <p class="vacio">No hay productos en el carrito.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    @endif

    <div style="text-align:center;">
        <a href="{{ url('/cliente/dashboard') }}" class="btn-volver">← Volver a Productos</a>
    </div>
</div>

</body>
</html>
