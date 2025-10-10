
<?php $__env->startSection('title','Lista de Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0"> Lista de Usuarios</h2>
        <a href="<?php echo e(route('admi.usuarios.create')); ?>" class="btn btn-primary fa fa-plus">
             Crear Usuario
        </a>
    </div>

    <table class="table table-hover table-bordered align-middle text-center shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Contacto</th>
                <th>Dirección</th>
                <th>Gmail</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($usuario->id_usuario); ?></td>
                    <td><?php echo e($usuario->primer_nombre); ?> <?php echo e($usuario->segundo_nombre); ?></td>
                    <td><?php echo e($usuario->primer_apellido); ?> <?php echo e($usuario->segundo_apellido); ?></td>   
                    <td><?php echo e($usuario->contacto); ?></td>
                    <td><?php echo e($usuario->direccion); ?></td>  
                    <td><?php echo e($usuario->gmail); ?></td>
                    <td><?php echo e($usuario->rol->nombre_rol); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('admi.usuarios.edit', $usuario->id_usuario)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="<?php echo e(route('admi.usuarios.destroy', $usuario->id_usuario)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\proyecto\cueromania\resources\views/admi/usuarios/index.blade.php ENDPATH**/ ?>