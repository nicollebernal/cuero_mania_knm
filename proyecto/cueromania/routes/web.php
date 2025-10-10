<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalizacionController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\LoginManualController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CarritoController;

Route::get('/', fn() => redirect()->route('login.form'));

Route::get('/login', [LoginManualController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginManualController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginManualController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/admin/dashboard', fn() => view('admi.panel'))->name('admin.dashboard');
Route::get('/empleado/dashboard', fn() => view('empleado.panel'))->name('empleado.dashboard');
Route::get('/cliente/dashboard', fn() => view('cliente.cliente'))->name('cliente.dashboard');

Route::prefix('admi')->name('admi.')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('personalizacion', PersonalizacionController::class);
    Route::resource('ventas', VentasController::class);
    Route::resource('pagos', PagosController::class);

    Route::get('pagos/{id_pagos}/edit', [PagosController::class, 'edit'])->name('pagos.edit');
    Route::get('usuarios/{usuario}/confirmar-eliminacion', [UsuarioController::class, 'confirmarEliminacion'])
        ->name('usuarios.confirmarEliminacion');
});

Route::prefix('cliente')->name('cliente.')->group(function () {
    Route::get('personalizacion/create', [PersonalizacionController::class, 'create'])->name('personalizacion.create');
    Route::post('personalizacion/store', [PersonalizacionController::class, 'store'])->name('personalizacion.store');
});

Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

