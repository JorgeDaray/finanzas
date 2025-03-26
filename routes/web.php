<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanzasPersonalesController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Auth;


// Ruta raíz que carga el index de finanzas personales
Route::get('/', [FinanzasPersonalesController::class, 'index']);

// Ruta de prueba para verificar la configuración de la base de datos
Route::get('/test', function () {
    dd(env('DB_DATABASE')); // Dump 'db' variable value one by one
});

Route::resource('categorias', CategoriaController::class);

// Rutas para transacciones (CRUD completo)
Route::resource('transacciones', FinanzasPersonalesController::class);

Route::get('/logout', function () {
    Auth::logout();  // Cerrar sesión
    return redirect('/');  // Redirigir a la página de inicio o donde desees
})->name('logout');


// Rutas de autenticación
Auth::routes();  // Esta línea ya configura las rutas de registro y login de forma automática.

// Ruta para la página de inicio después del login (home)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
