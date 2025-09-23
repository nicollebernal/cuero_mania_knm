<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3>Iniciar Sesión</h3>
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Correo" required></div>
          <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Contraseña" required></div>
          <button class="btn btn-primary w-100">Entrar</button>
        </form>
        <hr>
        <a href="{{ route('register') }}">Registrarse</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
