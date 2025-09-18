<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


Route::get('/', fn()=>redirect()->route('usuarios.index'));
Route::resource('usuarios', UsuarioController::class);