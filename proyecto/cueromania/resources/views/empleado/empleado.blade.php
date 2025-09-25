<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Cueromania - Panel Empleado</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #8d1b2e, #5a0f1b, #570a18);
      background-size: 400% 400%;
      animation: gradient 12s ease infinite;
      color: #fff;
    }

    @keyframes gradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .top-bar {
      background-color: #5a0f1b;
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
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      position: relative;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo img {
      height: 60px;
      border-radius: 10px;
    }

    .logo h2 {
      font-size: 28px;
      color: #8d1b2e;
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
      transition: 0.3s;
    }
    .menu-icons img:hover {
      transform: scale(1.2);
      opacity: 0.8;
    }

    /* Quitamos nav duplicado */
    nav {
      display: none;
    }

    .panel-container {
      max-width: 1100px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      backdrop-filter: blur(10px);
    }

    .panel-container h1 {
      text-align: center;
      margin-bottom: 40px;
      color: #fff;
      font-size: 32px;
    }

    .opciones-panel {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
    }

    .opcion-panel {
      width: 220px;
      height: 200px;
      background-color: white;
      border-radius: 16px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .opcion-panel:hover {
      transform: translateY(-8px) scale(1.05);
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }

    .opcion-panel img {
      width: 60px;
      height: 60px;
      margin-bottom: 15px;
    }

    .opcion-panel span {
      font-weight: bold;
      color: #8d1b2e;
      font-size: 18px;
    }

    footer {
      background-color: #5a0f1b;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      font-size: 14px;
    }

    /* Responsivo */
    @media (max-width: 768px) {
      .opciones-panel {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <div class="top-bar">Contacto: 123 456 789 | servicio@innovar.com</div>

  <header>
    <div class="logo">
      <img src="{{ asset('img/logo.jpeg') }}" alt="Cueromania Logo" />
      <h2>Cueromania</h2>
    </div>
    <div class="menu-icons">
      <img src="https://img.icons8.com/ios-glyphs/30/user--v1.png" alt="Inicio" onclick="window.location.href='index.html'" />
    </div>
  </header>

  <div class="panel-container">
    <h1>Panel del Empleado</h1>
    <div class="opciones-panel">
      <div class="opcion-panel">
        <a href="{{ route('empleado.ventas.index') }}">
          <img src="https://img.icons8.com/ios-filled/50/cash-register.png" alt="Registrar Venta" />
          <span>Registrar Venta</span>
        </a>
      </div>
      <div class="opcion-panel">
        <a href="empleado_facturacion.html">
          <img src="https://img.icons8.com/ios-filled/50/invoice.png" alt="Facturación" />
          <span>Facturación</span>
        </a>
      </div>
      <div class="opcion-panel">
        <a href="empleado_inventario.html">
          <img src="https://img.icons8.com/ios-filled/50/warehouse.png" alt="Inventario" />
          <span>Inventario</span>
        </a>
      </div>
      <div class="opcion-panel">
        <img src="https://img.icons8.com/ios-filled/50/conference.png" alt="Clientes" />
        <span>Clientes</span>
      </div>
    </div>
  </div>

  <footer>
    <p>Innovar S.A.S. | Tel: +57 312 456 7890 | Email: servicio@innovar.com</p>
    <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
  </footer>
</body>
</html>
