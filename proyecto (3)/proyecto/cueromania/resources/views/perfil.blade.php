<form method="POST" action="{{ route('perfil.actualizar') }}">
    @csrf
    @method('PUT')

    <label for="primer_nombre">Primer Nombre</label>
    <input type="text" id="primer_nombre" name="primer_nombre" class="form-control" value="{{ old('primer_nombre', $usuario->primer_nombre) }}" required />

    <label for="segundo_nombre">Segundo Nombre</label>
    <input type="text" id="segundo_nombre" name="segundo_nombre" class="form-control" value="{{ old('segundo_nombre', $usuario->segundo_nombre) }}" />

    <label for="primer_apellido">Primer Apellido</label>
    <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" value="{{ old('primer_apellido', $usuario->primer_apellido) }}" required />

    <label for="segundo_apellido">Segundo Apellido</label>
    <input type="text" id="segundo_apellido" name="segundo_apellido" class="form-control" value="{{ old('segundo_apellido', $usuario->segundo_apellido) }}" />

    <label for="direccion">Dirección</label>
    <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $usuario->direccion) }}" />

    <label for="contacto">Teléfono</label>
    <input type="text" id="contacto" name="contacto" class="form-control" value="{{ old('contacto', $usuario->contacto) }}" />

    <label for="gmail">Correo Electrónico</label>
    <input type="email" id="gmail" name="gmail" class="form-control" value="{{ old('gmail', $usuario->gmail) }}" required />

    <label for="clave">Nueva Contraseña (dejar en blanco para no cambiar)</label>
    <input type="password" id="clave" name="clave" class="form-control" placeholder="********" />

    <button type="submit" class="btn-submit">Guardar Cambios</button>
</form>
