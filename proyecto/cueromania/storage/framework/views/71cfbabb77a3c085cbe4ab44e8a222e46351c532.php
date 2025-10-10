
<?php $__env->startSection('title','Lista de Usuarios'); ?>
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center ">
    <h1 class="h2">Lista de Usuarios</h1>
    <a href="<?php echo e(route('usuarios.create')); ?>" class="btn btn-primary">Crear Usuario</a>
</div>
<table class="table table-hover table-bordered align-middle text-center shadow-sm">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>contacto</th>
            <th>Direccion</th>
            <th>gmail</th>
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
                <a href="<?php echo e(route('usuarios.show', $usuario->id_usuario)); ?>" class="btn btn-info btn-sm">Ver</a>
                <a href="<?php echo e(route('usuarios.edit', $usuario->id_usuario)); ?>" class="btn btn-warning btn-sm">Editar</a>
                <form action="<?php echo e(route('usuarios.destroy', $usuario->id_usuario)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/Interfaz/administrador/usuarios/index.blade.php ENDPATH**/ ?>