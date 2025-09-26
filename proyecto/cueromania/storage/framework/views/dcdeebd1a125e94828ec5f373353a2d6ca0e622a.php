

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4 text-center">Lista de Personalizaciones</h2>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success text-center">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="mb-3 text-end">
        <a href="<?php echo e(route('admi.personalizacion.create')); ?>" class="btn btn-primary">
            Nueva Personalización
        </a>
    </div>

    <table class="table table-hover table-bordered shadow-sm align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario (ID - Nombre)</th>
                <th>Fecha Solicitud</th>
                <th>Categoría</th>
                <th>Color</th>
                <th>Marca</th>
                <th>Género</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $personalizaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($p->id_personalizacion); ?></td>
                    <td>
                        <?php echo e($p->usuario->id_usuario); ?> <br>
                        <small class="text-muted">
                            <?php echo e($p->usuario->primer_nombre); ?> <?php echo e($p->usuario->primer_apellido); ?>

                        </small>
                    </td>
                    <td><?php echo e($p->fecha_solicitud); ?></td>
                    <td><?php echo e($p->categoria->nombre_categoria); ?></td>
                    <td><?php echo e($p->color->nombre_color); ?></td>
                    <td><?php echo e($p->marca->nombre_marca); ?></td>
                    <td><?php echo e($p->genero->nombre_genero); ?></td>
                    <td><?php echo e($p->descripcion); ?></td>
                    <td>
                        <?php if($p->imagen_personalizacion): ?>
                            <img src="<?php echo e(asset('storage/'.$p->imagen_personalizacion)); ?>" 
                                 alt="imagen" class="img-thumbnail" width="100">
                        <?php else: ?>
                            <span class="badge bg-secondary">Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admi.personalizacion.edit', $p->id_personalizacion)); ?>" 
                           class="btn btn-sm btn-warning">
                           ✏️ Editar
                        </a>

                        <form action="<?php echo e(route('admi.personalizacion.destroy', $p->id_personalizacion)); ?>" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta personalización?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="text-center text-muted">No hay personalizaciones registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/admi/personalizacion/index.blade.php ENDPATH**/ ?>