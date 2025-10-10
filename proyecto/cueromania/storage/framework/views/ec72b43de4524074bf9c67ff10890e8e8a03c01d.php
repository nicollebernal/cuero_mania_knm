

<?php $__env->startSection('title', 'Nueva Venta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Nueva Venta</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <li><?php echo e($error); ?></li> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admi.ventas.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="fecha_ventas" class="form-label">Fecha</label>
            <input type="date" name="fecha_ventas" class="form-control" value="<?php echo e(old('fecha_ventas')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado_venta" class="form-label">Estado</label>
            <input type="text" name="estado_venta" class="form-control" value="<?php echo e(old('estado_venta')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Total" class="form-label">Total</label>
            <input type="number" name="Total" class="form-control" value="<?php echo e(old('Total')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <input type="number" name="id_usuario" class="form-control" value="<?php echo e(old('id_usuario')); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?php echo e(route('admi.ventas.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\proyecto\cueromania\resources\views/admi/ventas/create.blade.php ENDPATH**/ ?>