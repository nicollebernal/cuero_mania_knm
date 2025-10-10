<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel de Administración - Cueromania</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f8f8f8;
      color: #333;
    }

    .top-bar {
      background-color: #7c1022;
      color: #fff;
      padding: 8px 25px;
      font-size: 14px;
      text-align: right;
      letter-spacing: 0.4px;
    }

    header {
      background-color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 15px 30px;
      border-bottom: 3px solid #7c1022;
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
      color: #7c1022;
      margin: 0;
      font-weight: 700;
    }

    .menu-icons {
      position: absolute;
      right: 30px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .menu-icons img {
      width: 28px;
      height: 28px;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .menu-icons img:hover {
      transform: scale(1.1);
    }

    .nombre-usuario {
      font-size: 15px;
      color: #7c1022;
      font-weight: 600;
    }

    .panel-container {
      max-width: 1100px;
      margin: 60px auto;
      background-color: #fff;
      border-radius: 16px;
      padding: 40px 20px 60px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .panel-container h1 {
      text-align: center;
      color: #7c1022;
      font-size: 28px;
      margin-bottom: 40px;
      font-weight: 700;
    }

    .opciones-panel {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 35px;
    }

    .opcion-panel {
      width: 200px;
      height: 200px;
      background: #fff;
      border-radius: 16px;
      border: 1px solid #eee;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: all 0.3s ease;
      text-decoration: none;
      color: #7c1022;
    }

    .opcion-panel:hover {
      transform: scale(1.05);
      background: #7c1022;
      color: #fff;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    .opcion-panel img {
      width: 55px;
      height: 55px;
      margin-bottom: 15px;
      transition: filter 0.3s ease;
      filter: invert(14%) sepia(83%) saturate(3229%) hue-rotate(334deg) brightness(86%) contrast(100%);
    }

    .opcion-panel:hover img {
      filter: brightness(10);
    }

    .opcion-panel span {
      font-weight: 600;
      font-size: 15px;
    }

    footer {
      background-color: #7c1022;
      color: white;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      margin-top: 60px;
    }

    footer p {
      margin: 4px 0;
    }

    @media (max-width: 768px) {
      .opciones-panel {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <div class="top-bar">
    Contacto: 123 456 789 | servicio@cueromania.com
  </div>

  <header>
    <div class="logo">
      <img src="<?php echo e(asset('img/logo.jpeg')); ?>" alt="Cueromania Logo" />
      <h2>Cueromania</h2>
    </div>

    <div class="menu-icons">
      <!-- ✅ Mostrar nombre del usuario logueado -->
      <?php if(session('usuario')): ?>
        <span class="nombre-usuario">
          <?php echo e(session('usuario')->primer_nombre); ?> <?php echo e(session('usuario')->primer_apellido); ?>

        </span>
      <?php endif; ?>

      <!-- Icono de persona (no se cambia nada) -->
      <img src="https://img.icons8.com/ios-glyphs/30/user--v1.png" 
           alt="Inicio"
           onclick="window.location.href='<?php echo e(route('login.form')); ?>'" />
    </div>
  </header>

  <div class="panel-container">
    <h1>Panel de Administración</h1>
    <div class="opciones-panel">
      <a href="<?php echo e(route('admi.usuarios.index')); ?>" class="opcion-panel">
        <img src="https://img.icons8.com/ios-filled/50/groups.png" />
        <span>Gestionar Usuarios</span>
      </a>

      <a href="<?php echo e(route('admi.personalizacion.index')); ?>" class="opcion-panel">
        <img src="https://img.icons8.com/ios-filled/50/paint-palette.png" />
        <span>Gestionar Personalización</span>
      </a>

      <a href="<?php echo e(route('admi.ventas.index')); ?>" class="opcion-panel">
        <img src="https://img.icons8.com/ios-filled/50/shopping-cart.png" />
        <span>Gestionar Ventas</span>
      </a>

      <a href="<?php echo e(route('admi.pagos.index')); ?>" class="opcion-panel">
        <img src="https://img.icons8.com/ios-filled/50/money-transfer.png" />
        <span>Gestionar Pagos</span>
      </a>
    </div>
  </div>

  <footer>
    <p>Cueromania S.A.S. | Tel: +57 312 456 7890 | Email: servicio@cueromania.com</p>
    <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
  </footer>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/admi/panel.blade.php ENDPATH**/ ?>