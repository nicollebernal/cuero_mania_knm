
<?php $__env->startSection('title', 'Listado de Pagos'); ?>

<?php $__env->startSection('content'); ?>

<h1 class="h4 mb-3">Listado de Pagos</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endif; ?>

<a href="<?php echo e(route('admi.pagos.create')); ?>" class="btn btn-success mb-3">
    Crear Pago
</a>

<table class="table table-striped table-hover table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>ID</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Método</th>
            <th>Opción</th>
            <th>Venta asociada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $pagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr class="text-center">
            <td><?php echo e($pago->id_pagos); ?></td>
            <td>$<?php echo e(number_format($pago->precio, 2)); ?></td>
            <td><?php echo e($pago->estado_pago); ?></td> <!-- Color eliminado -->
            <td><?php echo e($pago->metodo_pagos); ?></td>
            <td><?php echo e($pago->opcion_pagos); ?></td>
            <td>
                <?php if($pago->venta): ?>
                    Venta #<?php echo e($pago->venta->id_ventas); ?> - $<?php echo e(number_format($pago->venta->Total, 2)); ?>

                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo e(route('admi.pagos.edit', $pago->id_pagos)); ?>" class="btn btn-sm btn-warning">
                    Editar
                </a>

                <form action="<?php echo e(route('admi.pagos.destroy', $pago->id_pagos)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Deseas eliminar este pago?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="7" class="text-center fw-bold">No hay pagos registrados</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\proyecto\cueromania\resources\views/admi/pagos/index.blade.php ENDPATH**/ ?>