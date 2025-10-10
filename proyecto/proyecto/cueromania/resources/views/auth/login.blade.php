<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cueromania - Login</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Arial, sans-serif;
        background: url('{{ asset('img/fondo.png') }}') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    /* Capa oscura para dar contraste */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: -1;
    }

    .logo-container {
        margin-bottom: 20px;
        text-align: center;
    }

    .logo {
        width: 140px;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .login-container {
        width: 400px;
        padding: 40px;
        background: url('{{ asset('img/fondo.png') }}') no-repeat center center fixed;
        backdrop-filter: blur(10px); 
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        color: white;
        transition: all 0.3s ease-in-out;
    }

    .login-container:hover {
        background: url('{{ asset('img/fondo.png') }}') no-repeat center center fixed;
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
        padding: 14px 16px;
        margin: 12px 0;
        border: none;
        border-radius: 10px;
        outline: none;
        background: rgba(255,255,255,0.95);
        font-size: 15px;
        color: #333;
    }

    .login-container input[type="submit"] {
        width: 100%;
        background: linear-gradient(135deg, #b32424, #9e1b1bff);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        transition: background 0.3s ease;
    }

    .login-container input[type="submit"]:hover {
        background: linear-gradient(135deg, #d92e2e, #801414);
    }

    .error-msg {
        color: #ffd6d6;
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .register-link {
        text-align: center;
        margin-top: 18px;
        font-size: 15px;
        color: #eee;
    }

    .register-link a {
        color: #ffd6d6;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        text-decoration: underline;
        color: #ffffff;
    }

    /* Responsivo */
    @media (max-width: 480px) {
        .login-container {
            width: 85%;
            padding: 30px;
        }
        .logo {
            width: 120px;
        }
    }
    </style>
</head>

<body>
    <div class="logo-container">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Cueromania Logo" class="logo">
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
