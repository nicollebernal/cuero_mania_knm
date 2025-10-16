<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel de Administración - Cueromania</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #313030ff;
      color: #e0e0e0;
    }

   
    .sidebar {
      width: 250px;
      background-color: #1f1f1f;
      padding-top: 20px;
      flex-shrink: 0;
    }

    .sidebar .nav-link {
      color: #cfcfcf;
      font-weight: 500;
      padding: 12px 20px;
    }

   

    
    .main-content {
      flex-grow: 1;
      overflow-y: auto;
    }

    header {
      background-color: #1f1f1f;
      border-bottom: 2px solid #6e6768ff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #e0e0e0;
    }

    .logo-header {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo-header img {
      height: 50px;
      border-radius: 10px;
    }

    .logo-header h2 {
      font-size: 24px;
      margin: 0;
      color: #e0e0e0;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-info span {
      font-size: 15px;
      color: #ffffff;
      font-weight: 600;
    }

    .user-info img {
      width: 30px;
      height: 30px;
      cursor: pointer;
      filter: invert(100%);
    }

    .content-area {
      padding: 40px 30px;
    }

    .card-option {
      background-color: #2a2a2a;
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(87, 85, 85, 0.5);
      transition: transform 0.3s, background-color 0.3s;
      color: #ffffff;
    }

    .card-option:hover {
      transform: translateY(-5px) scale(1.02);
      background-color: #811a2bff;
      color: #ffffff;
    }

    .card-option .card-body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 160px;
    }

    .card-option .card-body img {
      width: 50px;
      height: 50px;
      margin-bottom: 15px;
      filter: invert(90%);
    }

    .card-option .card-body span {
      font-size: 16px;
      font-weight: 600;
      text-align: center;
    }

    footer {
      background-color: #1f1f1f;
      color: #e0e0e0;
      text-align: center;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }
      .logo-header h2 {
        font-size: 20px;
      }
      .card-option {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>
  <nav class="sidebar d-flex flex-column">
    <div class="px-3 mb-4">
      <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="img-fluid rounded" style="height:60px;">
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admi.usuarios.index') }}">Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admi.personalizacion.index') }}">Personalización</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admi.ventas.index') }}">Ventas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admi.pagos.index') }}">Pagos</a>
      </li>
      <li class="nav-item mt-auto mb-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-outline-light w-100">Cerrar Sesión</button>
        </form>
      </li>
    </ul>
  </nav>

  <div class="main-content">
    <header>
      <div class="logo-header">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Logo Cueromania">
        <h2>Cueromania</h2>
      </div>
      <div class="user-info">
        @if(session('usuario'))
          <span>{{ session('usuario')->primer_nombre }} {{ session('usuario')->primer_apellido }}</span>
        @endif
        <img src="https://img.icons8.com/ios-glyphs/30/user--v1.png" alt="Perfil" onclick="window.location.href='{{ route('login.form') }}'">
      </div>
    </header>

    <div class="content-area container-fluid">
      <h1 class="text-center mb-5" style="color: #ffffff;">Panel de Administración</h1>
      <div class="row justify-content-center gy-4">
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('admi.usuarios.index') }}" class="card card-option text-decoration-none">
            <div class="card-body">
              <img src="https://img.icons8.com/ios-filled/50/groups.png" alt="Usuarios">
              <span>Gestionar Usuarios</span>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('admi.personalizacion.index') }}" class="card card-option text-decoration-none">
            <div class="card-body">
              <img src="https://img.icons8.com/ios-filled/50/paint-palette.png" alt="Personalización">
              <span>Gestionar Personalización</span>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('admi.ventas.index') }}" class="card card-option text-decoration-none">
            <div class="card-body">
              <img src="https://img.icons8.com/ios-filled/50/shopping-cart.png" alt="Ventas">
              <span>Gestionar Ventas</span>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('admi.pagos.index') }}" class="card card-option text-decoration-none">
            <div class="card-body">
              <img src="https://img.icons8.com/ios-filled/50/money-transfer.png" alt="Pagos">
              <span>Gestionar Pagos</span>
            </div>
          </a>
        </div>
      </div>
    </div>

    <footer class="mt-5">
      <p>Cueromania S.A.S. | Tel: +57 312 456 7890 | servicio@cueromania.com</p>
      <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
