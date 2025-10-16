<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Curomania - Cliente</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/cliente.css')); ?>">
    <style>
        h1 { color: #8d1b2e; text-align: center; margin-top: 20px; }
        .productos { display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin-top: 30px; }
        .producto {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            padding: 20px;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .producto:hover { transform: scale(1.03); }
        .producto img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }
        .producto h3 { margin-top: 10px; font-size: 16px; color: #333; }
        .producto p { color: #8d1b2e; font-weight: bold; font-size: 18px; }
        .btn-carrito {
            background-color: #8d1b2e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-carrito:hover { background-color: #b32424; transform: scale(1.05); }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="<?php echo e(asset('img/logo.jpeg')); ?>" alt="Curomania Logo">
        <h2>Curomania</h2>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Buscar productos...">
    </div>

    <div class="menu-icons">
        <a href="<?php echo e(route('cliente.personalizacion.create')); ?>">
            <img src="https://img.icons8.com/ios-filled/30/paint-palette.png" alt="personalizacion" title="Solicitar Personalización">
        </a>

        <a href="<?php echo e(route('carrito.index')); ?>">
            <img src="https://img.icons8.com/ios-filled/30/shopping-cart.png" alt="carrito" title="Carrito">
        </a>

        <a href="<?php echo e(route('login.form')); ?>" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: white;">
            <img src="https://img.icons8.com/ios-filled/30/user--v1.png" alt="login" title="Iniciar Sesión">
            <?php if(session('usuario')): ?>
                <span style="font-size: 12px; color: black; margin-top: 3px;">
                    <?php echo e(session('usuario')->primer_nombre); ?>

                </span>
            <?php endif; ?>
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
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="producto">
                <img src="<?php echo e(asset('img/' . $producto->imagen)); ?>" alt="<?php echo e($producto->nombre); ?>">
                <h3><?php echo e($producto->nombre); ?></h3>
                <p>$<?php echo e(number_format($producto->precio, 0, ',', '.')); ?></p>
                <form action="<?php echo e(route('carrito.agregar', $producto->id_producto)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-carrito">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<footer>
    <p>Curomania S.A.S. | Tel: +57 312 456 7890 | Email: servicio@curomania.com</p>
    <p>Dirección: Calle 123 #45-67, Ciudad Colombia</p>
</footer>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/cliente/cliente.blade.php ENDPATH**/ ?>