<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Curomania - Cliente</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #8d1b2e, #5a0f1b, #570a18);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }

        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .top-bar {
            background-color: rgba(0,0,0,0.4);
            padding: 5px 20px;
            color: white;
            font-size: 14px;
            text-align: right;
        }

        header {
            background-color: rgba(255,255,255,0.9);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 60px;
            border-radius: 12px;
        }

        .logo h2 {
            font-size: 28px;
            color: #8d1b2e;
            margin: 0;
        }

        .search-bar {
            flex-grow: 1;
            text-align: center;
        }

        .search-bar input {
            width: 60%;
            max-width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
        }

        .menu-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu-icons a img {
            width: 30px;
            height: 30px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .menu-icons a img:hover {
            transform: scale(1.1);
        }

        nav {
            background-color: #8d1b2e;
            padding: 12px 30px;
            display: flex;
            justify-content: center;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            gap: 25px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffcc00;
        }

        .cliente-container {
            max-width: 1100px;
            margin: 30px auto;
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .cliente-container h1 {
            text-align: center;
            color: #8d1b2e;
            margin-bottom: 25px;
        }

        .productos {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .producto {
            background-color: #f9f9f9;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            width: 250px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .producto:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.2);
        }

        .producto img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .producto:hover img {
            transform: scale(1.05);
        }

        .producto h3 {
            margin: 10px 0;
            color: #333;
            font-size: 18px;
        }

        .producto p {
            margin: 5px 0;
            font-size: 16px;
            color: #8d1b2e;
            font-weight: bold;
        }

        .btn-carrito {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #8d1b2e;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-carrito:hover {
            background-color: #b32424;
        }

        footer {
            background-color: #8d1b2e;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .productos {
                flex-direction: column;
                align-items: center;
            }
            .search-bar input {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="top-bar">Contacto: 123 456 789 | servicio@curomania.com</div>

    <header>
        <div class="logo">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Curomania Logo">
            <h2>Curomania</h2>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar productos...">
        </div>
        <div class="menu-icons">
            <a href="{{ route('login.form') }}">
                <img src="https://img.icons8.com/ios-filled/30/user--v1.png" alt="login" title="Iniciar Sesión">
            </a>
            <a href="{{ route('cliente.personalizacion.create') }}">
                <img src="https://img.icons8.com/ios-filled/30/paint-palette.png" alt="personalizacion" title="Solicitar Personalización">
            </a>
            <a href="{{ route('carrito.ver') }}">
                <img src="https://img.icons8.com/ios-filled/30/shopping-cart.png" alt="carrito" title="Carrito">
            </a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Hombre</a></li>
            <li><a href="#">Mujer</a></li>
            <li><a href="#">Ofertas</a></li>
        </ul>
    </nav>

    <div class="cliente-container">
        <h1>Bienvenido Cliente</h1>

        <div class="productos">
            <div class="producto">
                <img src="{{ asset('img/chamarra.png') }}" alt="Chamarra">
                <h3>Chamarra M blanca cuero hombre poco uso</h3>
                <p>$370.000</p>
                <button class="btn-carrito" data-id="1">Agregar al carrito</button>
            </div>

            <div class="producto">
                <img src="{{ asset('img/beisbolera.png') }}" alt="Beisbolera">
                <h3>Chaqueta en cuero hombre poco uso</h3>
                <p>$300.000</p>
                <button class="btn-carrito" data-id="2">Agregar al carrito</button>
            </div>

            <div class="producto">
                <img src="{{ asset('img/piloto.png') }}" alt="Piloto">
                <h3>Chaqueta en cuero piloto L hombre poco uso</h3>
                <p>$850.000</p>
                <button class="btn-carrito" data-id="3">Agregar al carrito</button>
            </div>
        </div>
    </div>

    <footer>
        <p>Curomania S.A.S. | Tel: +57 312 456 7890 | Email: servicio@curomania.com</p>
        <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.btn-carrito').forEach(boton => {
        boton.addEventListener('click', () => {
          const idProducto = boton.dataset.id;

          fetch('/carrito/agregar', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id_producto: idProducto, cantidad: 1 })
          })
          .then(res => res.json())
          .then(data => {
            alert(data.message);
          })
          .catch(err => console.error(err));
        });
      });
    });
    </script>
</body>
</html>


