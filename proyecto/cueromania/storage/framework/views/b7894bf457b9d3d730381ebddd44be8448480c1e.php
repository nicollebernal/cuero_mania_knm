<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Cueromania</title>
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
      background-color: rgba(0, 0, 0, 0.4);
      color: white;
      padding: 5px 20px;
      font-size: 14px;
      text-align: right;
    }

    header {
      background-color: rgba(255,255,255,0.95);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 15px 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      position: relative;
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
      background-color: #8d1b2e;
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

    nav a:hover {
      color: #ffcc00;
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
      color: #8d1b2e;
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
      background-color: #f9f9f9;
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .opcion-panel:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(0,0,0,0.2);
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
      background-color: #8d1b2e;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <div class="top-bar">Contacto: 123 456 789 | servicio@cueromania.com</div>

  <header>
    <div class="logo">
      <img src="<?php echo e(asset('img/logo.jpeg')); ?>" alt="Cueromania Logo" />
      <h2>Cueromania</h2>
    </div>
    <div class="menu-icons">
      <img src="https://img.icons8.com/ios-glyphs/30/user--v1.png" 
           alt="inicio" 
           onclick="window.location.href='<?php echo e(route('admi.usuarios.index')); ?>'" />
    </div>
  </header>

 
  <div class="panel-container">
    <h1>Panel Administrador</h1>
    <div class="opciones-panel">
      <div class="opcion-panel">
        <a href="<?php echo e(route('admi.usuarios.index')); ?>">
          <img src="https://img.icons8.com/ios-filled/50/groups.png" />
          <span>Gestionar Usuarios</span>
        </a>
      </div>

      <div class="opcion-panel">
        <a href="<?php echo e(route('admi.personalizacion.index')); ?>">
          <img src="https://img.icons8.com/ios-filled/50/paint-palette.png" />
          <span>Gestionar Personalización</span>
        </a>
      </div>

      <div class="opcion-panel">
        <a href="<?php echo e(route('admi.ventas.index')); ?>">
          <img src="https://img.icons8.com/ios-filled/50/shopping-cart.png" />
          <span>Gestionar Ventas</span>
        </a>
      </div>

      <div class="opcion-panel">
        <a href="<?php echo e(route('admi.pagos.index')); ?>">
          <img src="https://img.icons8.com/ios-filled/50/money-transfer.png" />
          <span>Gestionar Pagos</span>
        </a>
      </div>
    </div>
  </div>

  <footer>
    <p>Cueromania S.A.S. | Tel: +57 312 456 7890 | Email: servicio@cueromania.com</p>
    <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
  </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/admi/panel.blade.php ENDPATH**/ ?>