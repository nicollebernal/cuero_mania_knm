

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4 text-center">Editar Personalización</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admi.personalizacion.update', $personalizacion->id_personalizacion)); ?>" 
          method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control"
                   value="<?php echo e(old('descripcion', $personalizacion->descripcion)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="fecha_solicitud" class="form-label">Fecha Solicitud</label>
            <input type="date" name="fecha_solicitud" class="form-control"
                   value="<?php echo e(old('fecha_solicitud', $personalizacion->fecha_solicitud)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" class="form-control" required>
                <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($usuario->id_usuario); ?>"
                        <?php echo e(old('id_usuario', $personalizacion->id_usuario) == $usuario->id_usuario ? 'selected' : ''); ?>>
                        <?php echo e($usuario->id_usuario); ?> - <?php echo e($usuario->primer_nombre); ?> <?php echo e($usuario->primer_apellido); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" class="form-control" required>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($categoria->id_categoria); ?>"
                        <?php echo e(old('id_categoria', $personalizacion->id_categoria) == $categoria->id_categoria ? 'selected' : ''); ?>>
                        <?php echo e($categoria->nombre_categoria); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_color" class="form-label">Color</label>
            <select name="id_color" class="form-control" required>
                <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($color->id_color); ?>"
                        <?php echo e(old('id_color', $personalizacion->id_color) == $color->id_color ? 'selected' : ''); ?>>
                        <?php echo e($color->nombre_color); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_marca" class="form-label">Marca</label>
            <select name="id_marca" class="form-control" required>
                <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($marca->id_marca); ?>"
                        <?php echo e(old('id_marca', $personalizacion->id_marca) == $marca->id_marca ? 'selected' : ''); ?>>
                        <?php echo e($marca->nombre_marca); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_genero" class="form-label">Género</label>
            <select name="id_genero" class="form-control" required>
                <?php $__currentLoopData = $generos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($genero->id_genero); ?>"
                        <?php echo e(old('id_genero', $personalizacion->id_genero) == $genero->id_genero ? 'selected' : ''); ?>>
                        <?php echo e($genero->nombre_genero); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen_personalizacion" class="form-label">Imagen</label><br>
            <?php if($personalizacion->imagen_personalizacion): ?>
                <img src="<?php echo e(asset('storage/'.$personalizacion->imagen_personalizacion)); ?>" 
                     alt="imagen actual" width="120" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="imagen_personalizacion" class="form-control">
            <small class="text-muted">Si no deseas cambiar la imagen, deja este campo vacío.</small>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="<?php echo e(route('admi.personalizacion.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\proyecto\cueromania\resources\views/admi/personalizacion/edit.blade.php ENDPATH**/ ?>