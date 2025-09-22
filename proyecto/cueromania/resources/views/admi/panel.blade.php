<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Cueromania</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #003366, #001a33); /* Azul oscuro */
    }

    .top-bar {
      background-color: #003366; /* Azul oscuro */
      color: white;
      padding: 5px 20px;
      font-size: 14px;
      text-align: right;
    }

    header {
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 15px 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo img {
      height: 60px;
    }

    .logo h2 {
      font-size: 28px;
      color: #003366; /* Azul oscuro */
      margin: 0;
    }

    .menu-icons {
      position: absolute;
      right: 30px;
    }

    .menu-icons img {
      width: 30px;
      height: 30px;
      cursor: pointer;
    }

    nav {
      background-color: #003366; /* Azul oscuro */
      padding: 10px 30px;
      display: flex;
      justify-content: center;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
      padding: 0;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
    }

    .panel-container {
      max-width: 1100px;
      margin: 30px auto;
      background-color: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .panel-container h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .opciones-panel {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .opcion-panel {
      width: 180px;
      height: 180px;
      background-color: #f0f0f0;
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .opcion-panel:hover {
      transform: scale(1.05);
    }

    .opcion-panel img {
      width: 50px;
      height: 50px;
      margin-bottom: 10px;
    }

    .opcion-panel span {
      font-weight: bold;
      color: #333;
    }

    footer {
      background-color: #003366; /* Azul oscuro */
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <div class="top-bar">Contacto: 123 456 789 | servicio@innovar.com</div>

  <header>
    <div class="logo">
      <img src="{{ asset('cartshop.jpg') }}" alt="CartShop Logo" />
      <h2>Curomania</h2>
    </div>
    <div class="menu-icons">
      <img src="https://img.icons8.com/ios-glyphs/30/user--v1.png" 
           alt="inicio" 
           onclick="window.location.href='{{ route('usuarios.index') }}'" />
    </div>
  </header>

  <nav>
    <ul>
      <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
      <li><a href="{{ route('personalizacion.index') }}">Personalización</a></li>
    </ul>
  </nav>

  <div class="panel-container">
    <h1>Panel Administrador</h1>
    <div class="opciones-panel">
      <div class="opcion-panel">
        <a href="{{ route('usuarios.index') }}">
          <img src="https://img.icons8.com/ios-filled/50/groups.png" />
          <span>Gestionar Usuarios</span>
        </a>
      </div>

      <div class="opcion-panel">
        <a href="{{ route('personalizacion.index') }}">
          <img src="https://img.icons8.com/ios-filled/50/paint-palette.png" />
          <span>Gestionar Personalización</span>
        </a>
      </div>
    </div>
  </div>

  <footer>
    <p>Innovar S.A.S. | Tel: +57 312 456 7890 | Email: servicio@innovar.com</p>
    <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
  </footer>
</body>
</html>
