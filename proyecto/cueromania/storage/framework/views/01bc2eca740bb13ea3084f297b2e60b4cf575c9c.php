

<?php $__env->startSection('title', 'Detalle Venta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Detalle de la Venta</h2>

    <table class="table table-bordered">
        <tr><th>ID</th><td><?php echo e($venta->id_ventas); ?></td></tr>
        <tr><th>Fecha</th><td><?php echo e($venta->fecha_ventas); ?></td></tr>
        <tr><th>Estado</th><td><?php echo e($venta->estado_venta); ?></td></tr>
        <tr><th>Total</th><td>$<?php echo e(number_format($venta->Total, 0, ',', '.')); ?></td></tr>
        <tr><th>Usuario</th>
            <td><?php echo e($venta->usuario ? $venta->usuario->primer_nombre . ' ' . $venta->usuario->primer_apellido : 'N/A'); ?></td>
        </tr>
    </table>

    <a href="<?php echo e(route('ventas.index')); ?>" class="btn btn-secondary">Volver</a>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/ventas/show.blade.php ENDPATH**/ ?>