<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalizacionController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PagosController;


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
