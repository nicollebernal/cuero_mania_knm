<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Compra - Cueromanía</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
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

        .factura-container {
            max-width: 900px;
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
        }

        .info {
            margin-bottom: 25px;
        }

        .info strong {
            color: #8d1b2e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #8d1b2e;
            color: white;
            padding: 12px;
            font-size: 16px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 15px;
        }

        tr:hover {
            background-color: #f8f8f8;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: 600;
            color: #8d1b2e;
            font-size: 18px;
        }

        .btn-volver {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #8d1b2e;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-volver:hover {
            background-color: #b32424;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<div class="factura-container">
    <h1>🧾 Factura de Compra</h1>

    <div class="info">
        <p><strong>Cliente:</strong> {{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }} {{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}</p>
        <p><strong>Fecha:</strong> {{ $venta->fecha_ventas }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: ${{ number_format($venta->Total, 0, ',', '.') }}</p>

    <div style="text-align:center;">
        <a href="{{ route('carrito.index') }}" class="btn-volver">← Volver al Carrito</a>
    </div>
</div>
</body>
</html>
