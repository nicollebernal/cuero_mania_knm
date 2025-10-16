<?php
// setup_auth.php
// Script para generar login, registro y roles en Laravel

function createFile($path, $content) {
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    file_put_contents($path, $content);
    echo "✅ Creado: $path\n";
}

/* ===============================
   1. LoginController
================================ */
$loginController = <<<'PHP'
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'empleado') {
                return redirect()->route('empleado.dashboard');
            } else {
                return redirect()->route('cliente.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
PHP;
createFile("app/Http/Controllers/Auth/LoginController.php", $loginController);

/* ===============================
   2. RegisterController
================================ */
$registerController = <<<'PHP'
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,empleado,cliente'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success','Registro exitoso, ahora inicia sesión');
    }
}
PHP;
createFile("app/Http/Controllers/Auth/RegisterController.php", $registerController);

/* ===============================
   3. Vistas
================================ */
$loginView = <<<'HTML'
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3>Iniciar Sesión</h3>
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Correo" required></div>
          <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Contraseña" required></div>
          <button class="btn btn-primary w-100">Entrar</button>
        </form>
        <hr>
        <a href="{{ route('register') }}">Registrarse</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
HTML;
createFile("resources/views/auth/login.blade.php", $loginView);

$registerView = <<<'HTML'
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3>Registrarse</h3>
        <form method="POST" action="{{ route('register.post') }}">
          @csrf
          <div class="mb-3"><input class="form-control" name="name" placeholder="Nombre" required></div>
          <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Correo" required></div>
          <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Contraseña" required></div>
          <div class="mb-3"><input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required></div>
          <div class="mb-3">
            <select class="form-select" name="role" required>
              <option value="cliente">Cliente</option>
              <option value="empleado">Empleado</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <button class="btn btn-success w-100">Registrarse</button>
        </form>
        <hr>
        <a href="{{ route('login') }}">Ya tengo cuenta</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
HTML;
createFile("resources/views/auth/register.blade.php", $registerView);

/* ===============================
   4. Dashboards
================================ */
createFile("resources/views/dashboards/admin.blade.php", "<h1>Panel Admin</h1>");
createFile("resources/views/dashboards/empleado.blade.php", "<h1>Panel Empleado</h1>");
createFile("resources/views/dashboards/cliente.blade.php", "<h1>Panel Cliente</h1>");

/* ===============================
   5. Rutas
================================ */
$routes = <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        $users = User::all();
        return view('dashboards.admin', compact('users'));
    })->name('admin.dashboard');

    Route::get('/empleado/dashboard', function () {
        return view('dashboards.empleado');
    })->name('empleado.dashboard');

    Route::get('/cliente/dashboard', function () {
        return view('dashboards.cliente');
    })->name('cliente.dashboard');
});
PHP;
createFile("routes/web.php", $routes);

echo "🎉 Archivos de login/registro creados correctamente.\n";