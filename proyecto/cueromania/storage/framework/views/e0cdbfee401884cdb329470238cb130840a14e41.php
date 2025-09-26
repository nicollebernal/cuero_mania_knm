

<?php $__env->startSection('title', 'Lista de Ventas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-3">Lista de Ventas</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('ventas.create')); ?>" class="btn btn-primary mb-3">Nueva Venta</a>

    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($venta->id_ventas); ?></td>
                    <td><?php echo e($venta->fecha_ventas); ?></td>
                    <td><?php echo e($venta->estado_venta); ?></td>
                    <td>$<?php echo e(number_format($venta->Total, 0, ',', '.')); ?></td>
                    <td><?php echo e($venta->usuario ? $venta->usuario->primer_nombre : 'N/A'); ?></td>
                    <td>
                        <a href="<?php echo e(route('ventas.show', $venta)); ?>" class="btn btn-info btn-sm">Ver</a>
                        <a href="<?php echo e(route('ventas.edit', $venta)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="<?php echo e(route('ventas.destroy', $venta)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta venta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6">No hay ventas registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/ventas/index.blade.php ENDPATH**/ ?>