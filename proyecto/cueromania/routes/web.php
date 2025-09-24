<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalizacionController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PagosController;
<<<<<<< HEAD
use App\Http\Controllers\LoginManualController;

Route::get('/', fn() => redirect()->route('login.form'));

Route::get('/login', [LoginManualController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginManualController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginManualController::class, 'logout'])->name('logout');
Route::get('/admin/dashboard', fn() => view('admi.panel'))->name('admin.dashboard');
Route::get('/empleado/dashboard', fn() => view('empleado.panel'))->name('empleado.dashboard');
Route::get('/cliente/dashboard', fn() => view('cliente.cliente'))->name('cliente.dashboard');


Route::prefix('admi')->name('admi.')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('personalizacion', PersonalizacionController::class);
    Route::resource('ventas', VentasController::class);
    Route::resource('pagos', PagosController::class);

    Route::get('/admi/pagos/{id_pagos}/edit', [PagosController::class, 'edit'])->name('admi.pagos.edit');

    Route::get('usuarios/{usuario}/confirmar-eliminacion', [UsuarioController::class, 'confirmarEliminacion'])
        ->name('usuarios.confirmarEliminacion');
});
=======


Route::get('/cliente', function () {
    return view('cliente.cliente');

});

Route::get('/', function () {
    return view('admi.panel');
})->name('admi.panel');

// 👇 Todas las rutas dentro del prefijo admi
Route::prefix('admi')->name('admi.')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('personalizacion', PersonalizacionController::class);
    Route::resource('ventas', VentasController::class);
    Route::resource('pagos', PagosController::class);
    Route::get('/admi/pagos/{id_pagos}/edit', [PagosController::class, 'edit'])->name('admi.pagos.edit');


    Route::get('usuarios/{usuario}/confirmar-eliminacion', [UsuarioController::class, 'confirmarEliminacion'])
        ->name('usuarios.confirmarEliminacion');
});
>>>>>>> 143d2bf4b7249fbe82dcf53d912f105bbf2607ad
