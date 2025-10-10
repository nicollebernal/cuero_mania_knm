
<?php $__env->startSection('title', 'Crear pago'); ?>

<?php $__env->startSection('content'); ?>

<h1 class="h4 mb-3">Crear pago</h1>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('admi.pagos.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio"
               value="<?php echo e(old('precio')); ?>" required>
    </div>

    <div class="mb-3">
        <label for="estado_pago" class="form-label">Estado del pago</label>
        <input type="text" class="form-control" id="estado_pago" name="estado_pago"
               value="<?php echo e(old('estado_pago')); ?>" required>
    </div>

    <div class="mb-3">
        <label for="metodo_pagos" class="form-label">Método de pago</label>
        <input type="text" class="form-control" id="metodo_pagos" name="metodo_pagos"
               value="<?php echo e(old('metodo_pagos')); ?>" required>
    </div>

    <div class="mb-3">
        <label for="opcion_pagos" class="form-label">Opción de pago</label>
        <input type="text" class="form-control" id="opcion_pagos" name="opcion_pagos"
               value="<?php echo e(old('opcion_pagos')); ?>" required>
    </div>

    <div class="mb-3">
        <label for="id_venta" class="form-label">Venta asociada</label>
        <select name="id_venta" id="id_venta" class="form-control" required>
            <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($venta->id_ventas); ?>"
                    <?php echo e(old('id_venta') == $venta->id_ventas ? 'selected' : ''); ?>>
                    Venta #<?php echo e($venta->id_ventas); ?> - Total $<?php echo e(number_format($venta->Total, 0)); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Crear pago</button>
    <a href="<?php echo e(route('admi.pagos.index')); ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\proyecto\cueromania\resources\views/admi/pagos/create.blade.php ENDPATH**/ ?>