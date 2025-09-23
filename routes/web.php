<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro del grupo
| que contiene el middleware "web". ¡Ahora crea algo grandioso!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Ruta protegida: Dashboard del usuario autenticado y verificado
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Ruta protegida: Solo accesible para usuarios con rol "admin"
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
});

// Ruta para asignar rol a un usuario
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/asignar-rol/{id}/{rol}', [UserController::class, 'asignarRol'])
        ->name('user.asignar-rol');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('servicios', ServicioController::class)->middleware('role:admin');
    Route::resource('reservas', ReservaController::class);
});

