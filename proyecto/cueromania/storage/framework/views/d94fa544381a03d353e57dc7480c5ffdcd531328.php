
<?php $__env->startSection('title', 'Editar Usuario'); ?>
<?php $__env->startSection('content'); ?>

<h1 class="h3 mb-4 text-center">Editar Usuario</h1>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?php echo e(route('admi.usuarios.update', $usuario->id_usuario)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id_usuario" class="form-label">Documento</label>
                    <input type="text" class="form-control" id="id_usuario" name="id_usuario"
                           value="<?php echo e(old('id_usuario', $usuario->id_usuario)); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="primer_nombre" class="form-label">Primer Nombre</label>
                    <input type="text" class="form-control" id="primer_nombre" name="primer_nombre"
                           value="<?php echo e(old('primer_nombre', $usuario->primer_nombre)); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                    <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre"
                           value="<?php echo e(old('segundo_nombre', $usuario->segundo_nombre)); ?>">
                </div>

                <div class="col-md-6">
                    <label for="primer_apellido" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                           value="<?php echo e(old('primer_apellido', $usuario->primer_apellido)); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                           value="<?php echo e(old('segundo_apellido', $usuario->segundo_apellido)); ?>">
                </div>

                <div class="col-md-6">
                    <label for="contacto" class="form-label">Contacto</label>
                    <input type="text" class="form-control" id="contacto" name="contacto"
                           value="<?php echo e(old('contacto', $usuario->contacto)); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                           value="<?php echo e(old('direccion', $usuario->direccion)); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="gmail" class="form-label">Gmail</label>
                    <input type="email" class="form-control" id="gmail" name="gmail"
                           value="<?php echo e(old('gmail', $usuario->gmail)); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select class="form-select" id="id_rol" name="id_rol" required>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rol->id_rol); ?>"
                                <?php echo e(old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : ''); ?>>
                                <?php echo e($rol->nombre_rol); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                <a href="<?php echo e(route('admi.usuarios.index')); ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/admi/usuarios/edit.blade.php ENDPATH**/ ?>