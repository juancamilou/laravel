<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Registro y login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard para usuarios autenticados
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Rutas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::resource('cursos', CursoController::class);
Route::get('/cursos/{id}/inscritos', [CursoController::class, 'verInscritos'])->name('cursos.inscritos');
Route::get('/usuarios/ajax', [App\Http\Controllers\AuthController::class, 'getUsuariosRegistrados']);
Route::get('/api/usuarios-registrados', [AuthController::class, 'getUsuariosRegistrados'])->middleware('auth');



});

// Rutas para estudiantes autenticados
Route::middleware(['auth'])->group(function () {
Route::post('/cursos/{id}/inscribirse', [CursoController::class, 'inscribirse'])->name('cursos.inscribirse');
Route::post('/cursos/{id}/desinscribirse', [CursoController::class, 'desinscribirse'])->name('cursos.desinscribirse');
Route::get('/explorar-cursos', [CursoController::class, 'explorar'])->name('cursos.explorar');
});
