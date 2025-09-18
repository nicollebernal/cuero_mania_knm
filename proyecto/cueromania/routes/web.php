<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', fn()=>redirect()->route('Interfaz.login'));
Route::resource('usuarios', UsuarioController::class);