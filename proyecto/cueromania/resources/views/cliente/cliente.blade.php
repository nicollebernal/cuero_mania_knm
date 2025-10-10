<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Curomania - Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>

    <header>
        <div class="logo">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Curomania Logo">
            <h2>Curomania</h2>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Buscar productos...">
        </div>

        <div class="menu-icons">

            <a href="{{ route('cliente.personalizacion.create') }}">
                <img src="https://img.icons8.com/ios-filled/30/paint-palette.png" alt="personalizacion" title="Solicitar Personalización">
            </a>

            <!-- Ícono del carrito -->
            <a href="{{ route('carrito.ver') }}">
                <img src="https://img.icons8.com/ios-filled/30/shopping-cart.png" alt="carrito" title="Carrito">
            
            </a>

            <a href="{{ route('login.form') }}" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: white;">
                <img src="https://img.icons8.com/ios-filled/30/user--v1.png" alt="login" title="Iniciar Sesión">
                
                @if(session('usuario'))
                    <span style="font-size: 12px; color: black; margin-top: 3px;">
                        {{ session('usuario')->primer_nombre }}
                    </span>
                @endif
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
