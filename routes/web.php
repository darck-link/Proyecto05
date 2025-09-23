<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //  RUTAS PARA TODOS LOS USUARIOS AUTENTICADOS
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

    //  RUTAS PROTEGIDAS: Usuarios solo pueden editar/eliminar sus propias reservas
    Route::middleware('user.reserva')->group(function () {
        Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
        Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
        Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
    });

    //  RUTAS SOLO PARA ADMINISTRADORES
    Route::middleware(['admin'])->group(function () {
        // Panel de administración
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Gestión de servicios (solo admin)
        Route::resource('servicios', ServicioController::class);
        
        // Gestión de usuarios (solo admin)
        Route::get('/asignar-rol/{id}/{rol}', [UserController::class, 'asignarRol'])->name('user.asignar-rol');
        
        // Admin puede ver todas las reservas (vista especial)
        Route::get('/admin/reservas', [ReservaController::class, 'adminIndex'])->name('admin.reservas.index');
    });
});