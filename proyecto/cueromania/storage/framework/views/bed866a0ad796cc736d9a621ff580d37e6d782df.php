<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito</title>
</head>
<body>
<h1>Mi Carrito</h1>

<?php if(session('success')): ?>
  <p style="color:green;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<?php if(empty($carrito)): ?>
  <p>No hay productos en el carrito</p>
<?php else: ?>
  <table border="1" cellpadding="8">
    <tr>
      <th>ID Producto</th>
      <th>Cantidad</th>
      <th>Acciones</th>
    </tr>
    <?php $__currentLoopData = $carrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($item['id_producto']); ?></td>
        <td><?php echo e($item['cantidad']); ?></td>
        <td>
          <form action="<?php echo e(route('carrito.eliminar', $id)); ?>" method="POST" onsubmit="return confirm('¿Eliminar este producto del carrito?')">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </table>
<?php endif; ?>

<a href="<?php echo e(url('/cliente/dashboard')); ?>">Volver a productos</a>
</body>
</html>
<?php /**PATH D:\proyecto\cueromania\resources\views/cliente/carrito.blade.php ENDPATH**/ ?>