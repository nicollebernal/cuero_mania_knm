<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Editar Perfil - Curomania</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
    }

    header {
      background-color: #1f1f1f;
      padding: 18px 32px;
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

    nav ul {
      list-style: none;
      display: flex;
      justify-content: center;
      padding: 0;
      margin: 0;
      gap: 30px;
      background-color: #2a2a2a;
      padding: 10px 0;
    }

    nav ul li a {
      color: #ffffff;
      text-decoration: none;
      font-weight: 500;
    }

    nav ul li a:hover {
      color: #676566ff;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #1f1f1f;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #d5d3d3ff;
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
      display: block;
    }

    input.form-control, input.form-control:focus {
      background-color: #4b4b4bff;
      border: none;
      color: #fff;
      border-radius: 10px;
      padding: 10px 15px;
    }

    .btn-submit {
      background-color: #8d1b2e;
      color: white;
      border: none;
      padding: 18px 27px;
      border-radius: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 100%;
      margin-top: 20px;
    }

    .btn-submit:hover {
      background-color: #d14848ff;
      transform: scale(1.05);
    }

    .alert {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="{{ asset('img/logo.jpeg') }}" alt="Curomania Logo" />
    <h2>Curomania</h2>
  </div>
</header>

<nav>
  <ul>
    <li><a href="{{ route('cliente.dashboard') }}">Inicio</a></li>
    <li><a href="#">Hombre</a></li>
    <li><a href="#">Mujer</a></li>
    <li><a href="#">Ofertas</a></li>
  </ul>
</nav>

<div class="container">
  <h1>Editar Perfil</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('perfil.update') }}">
    @csrf
    @method('PUT')

    <header>
  <div class="logo">
    <img src="{{ asset('img/logo.jpeg') }}" alt="Curomania Logo" />
    <h2>Curomania</h2>
  </div>
</header>

<nav>
  <ul>
    <li><a href="{{ route('cliente.dashboard') }}">Inicio</a></li>
    <li><a href="#">Hombre</a></li>
    <li><a href="#">Mujer</a></li>
    <li><a href="#">Ofertas</a></li>
  </ul>
</nav>

<div class="container">
  <h1>Editar Perfil</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('perfil.update') }}">
    @csrf
    @method('PUT')

    <label for="primer_nombre">Primer Nombre</label>
    <input type="text" id="primer_nombre" name="primer_nombre" class="form-control" value="{{ old('primer_nombre', $usuario->primer_nombre) }}" required />

    <label for="segundo_nombre">Segundo Nombre</label>
    <input type="text" id="segundo_nombre" name="segundo_nombre" class="form-control" value="{{ old('segundo_nombre', $usuario->segundo_nombre) }}" />

    <label for="primer_apellido">Primer Apellido</label>
    <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" value="{{ old('primer_apellido', $usuario->primer_apellido) }}" required />

    <label for="segundo_apellido">Segundo Apellido</label>
    <input type="text" id="segundo_apellido" name="segundo_apellido" class="form-control" value="{{ old('segundo_apellido', $usuario->segundo_apellido) }}" />

    <label for="direccion">Dirección</label>
    <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $usuario->direccion) }}" />

    <label for="contacto">Teléfono</label>
    <input type="text" id="contacto" name="contacto" class="form-control" value="{{ old('contacto', $usuario->contacto) }}" />

    <label for="gmail">Correo Electrónico</label>
    <input type="email" id="gmail" name="gmail" class="form-control" value="{{ old('gmail', $usuario->gmail) }}" required />

    <label for="clave">Nueva Contraseña (dejar en blanco para no cambiar)</label>
    <input type="password" id="clave" name="clave" class="form-control" placeholder="********" />

    <button type="submit" class="btn-submit">Guardar Cambios</button>
  </form>
</div>

<footer style="text-align:center; padding: 20px; color:#ccc; margin-top: 40px;">
  <p>Curomania S.A.S. | Tel: +57 312 456 7890 | servicio@curomania.com</p>
  <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <button type="submit" class="btn-submit">Guardar Cambios</button>
  </form>
</div>

<footer style="text-align:center; padding: 20px; color:#ccc; margin-top: 40px;">
  <p>Curomania S.A.S. | Tel: +57 312 456 7890 | servicio@curomania.com</p>
  <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
