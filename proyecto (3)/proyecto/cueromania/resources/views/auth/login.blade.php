<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cueromania - Login</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: url('{{ asset('img/esoo.webp') }}') no-repeat center center fixed ;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .logo {
            width: 100px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            margin-right: 30px;
        }

        .login-card {
            z-index: 1;
            width: 100%;
            max-width: 340px;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 14px;
            padding: 25px 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
            color: white;
            height: 300px;
        }

        .form-control::placeholder {
            color: #e0dcdcff;
        }

        .btn-login {
            
            background: linear-gradient(135deg, #b32424, #9e1b1b);
            border: none;
            font-size: 15px;
            padding: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #d92e2e, #801414);
        }

        .error-msg {
            color: #ffd6d6;
            font-size: 13px;
            text-align: center;
            margin-bottom: 10px;
        }

        .register-link {
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #e0dcdcff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="text-center mb-3">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Cueromania Logo" class="logo">
    </div>

    <div class="login-card">
        <h4 class="text-center mb-3">Iniciar Sesión</h4>

        {{-- Mostrar errores --}}
        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <div class="mb-4">
                <input type="email" name="gmail" class="form-control form-control-xl" placeholder="Correo Gmail" required>
            </div>
            <div class="mb-4  width" >
                <input type="password" name="clave" class="form-control form-control-xl" placeholder="Contraseña" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-login">Ingresar</button>
            </div>
        </form>

        <div class="register-link">
            ¿No tienes cuenta? <a href="{{ route('register.form') }}">Regístrate aquí</a>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
