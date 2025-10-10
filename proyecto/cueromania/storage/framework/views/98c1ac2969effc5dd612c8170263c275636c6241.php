

<?php $__env->startSection('title', 'Editar Venta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Editar Venta</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <li><?php echo e($error); ?></li> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('ventas.update', $venta)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="fecha_ventas" class="form-label">Fecha</label>
            <input type="date" name="fecha_ventas" class="form-control" 
                   value="<?php echo e(old('fecha_ventas', $venta->fecha_ventas)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado_venta" class="form-label">Estado</label>
            <input type="text" name="estado_venta" class="form-control" 
                   value="<?php echo e(old('estado_venta', $venta->estado_venta)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Total" class="form-label">Total</label>
            <input type="number" name="Total" class="form-control" 
                   value="<?php echo e(old('Total', $venta->Total)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <input type="number" name="id_usuario" class="form-control" 
                   value="<?php echo e(old('id_usuario', $venta->id_usuario)); ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="<?php echo e(route('ventas.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/ventas/edit.blade.php ENDPATH**/ ?>