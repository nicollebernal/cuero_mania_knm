<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalizacionController;

// Página de inicio: panel administrador
Route::get('/', function () {
    return view('admi.panel');
})->name('admi.panel');

// CRUD Personalización
Route::resource('personalizacion', PersonalizacionController::class);

// CRUD Usuarios
Route::resource('usuarios', UsuarioController::class);
Route::get('usuarios/{usuario}/confirmar-eliminacion', [UsuarioController::class, 'confirmarEliminacion'])->name('usuarios.confirmarEliminacion');
