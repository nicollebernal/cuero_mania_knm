<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioDAO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginManualController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'gmail' => 'required|email',
            'clave' => 'required|string',
        ]);

        // Buscar usuario por gmail (sin filtrar por clave aún)
        $usuario = UsuarioDAO::with('rol')
            ->where('gmail', $request->gmail)
            ->first();

        if (! $usuario) {
            return back()->withErrors(['gmail' => 'Usuario o contraseña incorrectos']);
        }

        $stored = (string) $usuario->clave;
        $input  = $request->clave;

        // Detectar si el valor almacenado parece ser un hash (bcrypt/argon)
        $hashPrefixes = ['\$2y\$', '\$2a\$', '\$2b\$', 'argon2i', 'argon2id'];
        $isHashed = false;
        foreach ($hashPrefixes as $prefix) {
            if (Str::startsWith($stored, trim($prefix, '\\'))) {
                $isHashed = true;
                break;
            }
        }

        // Validación: si está hasheado usar Hash::check, sino comparar texto plano
        $valid = $isHashed ? Hash::check($input, $stored) : ($input === $stored);

        if (! $valid) {
            return back()->withErrors(['gmail' => 'Usuario o contraseña incorrectos']);
        }

        // Login OK: guardar en sesión y redirigir según id_rol
        session(['usuario' => $usuario]);

        switch ($usuario->id_rol) {
            case 2: // administrador
                return redirect()->route('admin.dashboard');
            case 3: // empleado
                return redirect()->route('empleado.dashboard');
            case 1: // cliente
            default:
                return redirect()->route('cliente.dashboard');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('usuario');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}