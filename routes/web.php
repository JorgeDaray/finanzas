<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanzasPersonalesController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Auth;
// routes/web.php
use App\Http\Controllers\UserController;

// Ruta raíz que carga el index de finanzas personales
Route::get('/', [FinanzasPersonalesController::class, 'index']);

// Ruta de prueba para verificar la configuración de la base de datos
Route::get('/test', function () {
    dd(env('DB_DATABASE')); // Dump 'db' variable value one by one
});

// routes/web.php
Route::resource('categorias', CategoriaController::class);

// Rutas para transacciones (CRUD completo)
Route::resource('transacciones', FinanzasPersonalesController::class);

// Autenticación
Auth::routes(); // Esta línea maneja las rutas de autenticación automáticamente.

// En routes/web.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
});

Route::resource('roles', RoleController::class);

// Ruta para listar usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Ruta para mostrar los detalles de un usuario
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// Ruta para la página de inicio después del login (home)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
