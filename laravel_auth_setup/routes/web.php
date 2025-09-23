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
