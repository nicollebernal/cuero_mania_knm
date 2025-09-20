<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalizacionController;

Route::resource('personalizacion', PersonalizacionController::class);
Route::get('/', fn()=>redirect()->route('usuarios.index'));
Route::resource('usuarios', UsuarioController::class);
Route::get('usuarios/{usuario}/confirmar-eliminacion', [UsuarioController::class, 'confirmarEliminacion'])->name('usuarios.confirmarEliminacion');