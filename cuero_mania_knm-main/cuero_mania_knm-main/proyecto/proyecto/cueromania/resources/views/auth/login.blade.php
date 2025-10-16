<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Curomania - Login</title>
    <link rel="stylesheet" href="{{ asset('css/sestilos.css') }}">
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

        .logo-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .logo {
            width: 140px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        }

        .login-container {
            width: 320px;
            padding: 30px 35px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.5);
            backdrop-filter: blur(8px);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #fff;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 12px 14px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            outline: none;
            background: rgba(255,255,255,0.9);
            font-size: 14px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            background: linear-gradient(135deg, #b32424, #6a0f0f);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .login-container input[type="submit"]:hover {
            background: linear-gradient(135deg, #d92e2e, #801414);
        }

        .error-msg {
            color: #ffb3b3;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #ffd6d6;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Curomania Logo" class="logo">
    </div>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        {{-- Mostrar errores --}}
        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <input type="email" name="gmail" placeholder="Correo Gmail" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <input type="submit" value="Ingresar">
        </form>

        <div class="register-link">
            ¿No tienes cuenta? <a href="{{ route('register.form') }}">Regístrate aquí</a>
        </div>
    </div>
</body>
</html>
