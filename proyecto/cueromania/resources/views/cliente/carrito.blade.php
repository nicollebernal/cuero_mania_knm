<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito - Cueromanía</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #8d1b2e, #5a0f1b, #570a18);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
            font-family: 'Montserrat', sans-serif;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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

        .alert {
            text-align: center;
            font-weight: 600;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .btn-volver, .btn-pagar {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            background-color: #8d1b2e;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-volver:hover, .btn-pagar:hover {
            background-color: #b32424;
            transform: scale(1.05);
        }

        .vacio {
            text-align: center;
            color: #555;
            font-size: 18px;
            margin-top: 30px;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: 600;
            color: #8d1b2e;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="carrito-container">
    <h1>🛒 Mi Carrito</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($carrito) > 0)
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                @csrf
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total: ${{ number_format($total, 0, ',', '.') }}</p>

        <div style="text-align:center;">
            <form action="{{ route('carrito.pagar') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn-pagar"> Pagar</button>
            </form>
            <a href="{{ url('/cliente/dashboard') }}" class="btn-volver">← Volver a Productos</a>
        </div>
    @else
        <p class="vacio">No hay productos en el carrito.</p>
    @endif
</div>

</body>
</html>
