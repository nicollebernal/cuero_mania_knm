<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Curomania - Registro</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/sestilos.css')); ?>">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #8d1b2eff, #5a0f1b, #570a18ff);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .register-container {
            width: 380px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.5);
            backdrop-filter: blur(8px);
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #fff;
            font-weight: 600;
        }

        .register-container input {
            width: 90%;
            padding: 12px 14px;
            margin: 8px 0;
            border: none;
            border-radius: 10px;
            outline: none;
            background: rgba(255,255,255,0.9);
            font-size: 14px;
        }

        .register-container input[type="submit"] {
            width: 100%;
            background: linear-gradient(135deg, #b32424, #6a0f0f);
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .register-container input[type="submit"]:hover {
            background: linear-gradient(135deg, #d92e2e, #801414);
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #ffd6d6;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-msg {
            color: #ffb3b3;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registro</h2>

        
        <?php if($errors->any()): ?>
            <div class="error-msg"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register.process')); ?>">
            <?php echo csrf_field(); ?>
            <input type="text" name="id_usuario" placeholder="Documento de identidad" required>
            <input type="text" name="primer_nombre" placeholder="Primer Nombre" required>
            <input type="text" name="segundo_nombre" placeholder="Segundo Nombre (opcional)">
            <input type="text" name="primer_apellido" placeholder="Primer Apellido" required>
            <input type="text" name="segundo_apellido" placeholder="Segundo Apellido (opcional)">
            <input type="text" name="direccion" placeholder="Dirección de residencia" required>
            <input type="text" name="contacto" placeholder="Teléfono o Celular" required>
            <input type="email" name="gmail" placeholder="Correo Gmail" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <input type="password" name="clave_confirmation" placeholder="Confirmar Contraseña" required>
            <input type="submit" value="Registrarse">
        </form>

        <div class="login-link">
            ¿Ya tienes cuenta? <a href="<?php echo e(route('login.form')); ?>">Inicia sesión aquí</a>
        </div>
    </div>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\proyecto\cueromania\resources\views/auth/registro.blade.php ENDPATH**/ ?>