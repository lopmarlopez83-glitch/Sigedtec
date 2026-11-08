<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SecurityResetController; // 🔽 Agregado
use Illuminate\Support\Facades\Route;

// Ruta raíz: redirige al dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// 🔽 Dashboard personalizado (con contadores) en lugar del de Breeze
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 🔽 Rutas de perfil (las que trae Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔽 Rutas de nuestra aplicación (con middleware de rol)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('equipos', EquipoController::class);
    Route::resource('asignaciones', AsignacionController::class);
    Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('solicitudes', SolicitudController::class)->except(['edit', 'update', 'destroy'])->parameters([
        'solicitudes' => 'solicitud'
    ]);
    Route::post('solicitudes/{solicitud}/aprobar', [SolicitudController::class, 'aprobar'])
        ->middleware('role:admin')
        ->name('solicitudes.aprobar');
    Route::post('solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])
        ->middleware('role:admin')
        ->name('solicitudes.rechazar');
});

// 🔽 Rutas para recuperación con preguntas de seguridad (accesibles sin login)
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password-security', [SecurityResetController::class, 'showEmailForm'])->name('password.security.email');
    Route::post('/forgot-password-security', [SecurityResetController::class, 'checkEmail'])->name('password.security.check');
    Route::get('/forgot-password-security/question/{email}', [SecurityResetController::class, 'showQuestion'])->name('password.security.question');
    Route::post('/forgot-password-security/reset/{email}', [SecurityResetController::class, 'resetPassword'])->name('password.security.reset');
});

// 🔽 Rutas de autenticación de Breeze (login, registro, etc.)
require __DIR__.'/auth.php';