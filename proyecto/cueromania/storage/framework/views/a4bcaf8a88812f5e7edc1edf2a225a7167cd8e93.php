

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Nueva Personalización</h2>

    <form action="<?php echo e(route('admi.personalizacion.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- ID Usuario primero -->
        <div class="mb-3">
            <label for="id_usuario">ID Usuario</label>
            <select name="id_usuario" class="form-select" required>
                <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($usuario->id_usuario); ?>"><?php echo e($usuario->id_usuario); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen_personalizacion">Imagen</label>
            <input type="file" name="imagen_personalizacion" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="fecha_solicitud">Fecha de Solicitud</label>
            <input type="date" name="fecha_solicitud" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_categoria">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($categoria->id_categoria); ?>"><?php echo e($categoria->nombre_categoria); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_color">Color</label>
            <select name="id_color" class="form-select" required>
                <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($color->id_color); ?>"><?php echo e($color->nombre_color); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_marca">Marca</label>
            <select name="id_marca" class="form-select" required>
                <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($marca->id_marca); ?>"><?php echo e($marca->nombre_marca); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_genero">Género</label>
            <select name="id_genero" class="form-select" required>
                <?php $__currentLoopData = $generos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($genero->id_genero); ?>"><?php echo e($genero->nombre_genero); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Descripción al final -->
        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?php echo e(route('admi.personalizacion.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/admi/personalizacion/create.blade.php ENDPATH**/ ?>