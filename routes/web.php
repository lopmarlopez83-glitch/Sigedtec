<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard (solo autenticados, por ahora sin middleware de rol)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CRUD de Categorías (solo admin)
Route::resource('categorias', CategoriaController::class);

// CRUD de Equipos (solo admin)
Route::resource('equipos', EquipoController::class);

// Solicitudes (solicitante crea, admin aprueba/rechaza)
Route::resource('solicitudes', SolicitudController::class);

// Aprobación/rechazo de solicitudes (solo admin)
Route::post('solicitudes/{solicitud}/aprobar', [SolicitudController::class, 'aprobar'])->name('solicitudes.aprobar');
Route::post('solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])->name('solicitudes.rechazar');

// Asignaciones (solo admin)
Route::resource('asignaciones', AsignacionController::class);