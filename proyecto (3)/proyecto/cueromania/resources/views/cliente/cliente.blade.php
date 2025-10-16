<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Curomania - Cliente</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
    }

    header {
      background-color: #1f1f1f;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #8d1b2e;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo img {
      height: 50px;
      border-radius: 10px;
    }

    .logo h2 {
      font-size: 24px;
      margin: 0;
      color: #ffffff;
    }

    .search-bar input {
      background-color: #4b4b4bff;
      border: none;
      border-radius: 20px;
      padding: 8px 20px;
      color: #fff;
      width: 300px;
    }

    .search-bar input::placeholder {
      color: #aaa;
    }

    .menu-icons {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .menu-icons img {
      filter: invert(100%);
      width: 28px;
      height: 28px;
      transition: transform 0.2s;
    }

    .menu-icons img:hover {
      transform: scale(1.1);
    }

    nav {
      background-color: #2a2a2a;
      padding: 10px 0;
    }

    nav ul {
      list-style: none;
      display: flex;
      justify-content: center;
      margin: 0;
      padding: 0;
      gap: 30px;
    }

    nav ul li a {
      text-decoration: none;
      color: #ffffff;
      font-weight: 500;
    }

    nav ul li a:hover {
      color: #676566ff;
    }

    .cliente-container {
      padding: 40px 30px;
    }

    h1 {
      text-align: center;
      color: #d5d3d3ff;
      margin-bottom: 40px;
    }

    .producto-card {
      background-color: #1f1f1f;
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.5);
      color: #fff;
      transition: transform 0.3s ease;
    }

    .producto-card:hover {
      transform: translateY(-5px);
    }

    .producto-card img {
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
      height: 250px;
      object-fit: cover;
    }

    .producto-card h3 {
      font-size: 18px;
      margin-top: 10px;
      color: #ffffff;
    }

    .producto-card p {
      font-size: 18px;
      color: #b2afb0ff;
      font-weight: bold;
    }

    .btn-carrito {
      background-color: #8d1b2e;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-carrito:hover {
      background-color: #b32424;
      transform: scale(1.05);
    }

    footer {
      background-color: #1f1f1f;
      color: #e0e0e0;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .search-bar input {
        width: 180px;
      }

      .menu-icons {
        gap: 12px;
      }
    }
  </style>
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
      <img src="https://img.icons8.com/ios-filled/30/paint-palette.png" title="Solicitar Personalización" />
    </a>
    <a href="{{ route('carrito.index') }}">
      <img src="https://img.icons8.com/ios-filled/30/shopping-cart.png" title="Carrito" />
    </a>
    <a href="{{ route('login.form') }}" style="text-decoration: none; text-align: center;">
      <img src="https://img.icons8.com/ios-filled/30/user--v1.png" title="Iniciar Sesión" />
      @if(session('usuario'))
        <span style="font-size: 12px; color: #ffffff; display: block;">{{ session('usuario')->primer_nombre }}</span>
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

  <div class="row justify-content-center g-4">
    @foreach($productos as $producto)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card producto-card h-100">
          <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
          <div class="card-body text-center d-flex flex-column justify-content-between">
            <h3>{{ $producto->nombre }}</h3>
            <p>${{ number_format($producto->precio, 0, ',', '.') }}</p>
            <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
              @csrf
              <button type="submit" class="btn-carrito mt-2">Agregar al carrito</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<footer>
  <p>Curomania S.A.S. | Tel: +57 312 456 7890 | servicio@curomania.com</p>
  <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
