<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rotas Públicas (Front-end)
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/projetos', [SiteController::class, 'projects'])->name('site.projects');
Route::get('/projetos/{slug}', [SiteController::class, 'show'])->name('site.project.details');

// 2. Rotas de Autenticação do Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/2fa', [AuthController::class, 'show2FAForm'])->name('admin.2fa');
    Route::post('/2fa', [AuthController::class, 'verify2FA']);
});

// 3. Rotas Protegidas do Painel Admin (TUDO aqui dentro recebe o prefixo /admin e o nome admin.)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Projetos
    Route::get('/projetos', [ProjectController::class, 'index'])->name('projetos.index');
    Route::get('/projetos/criar', [ProjectController::class, 'create'])->name('projetos.create');
    Route::post('/projetos', [ProjectController::class, 'store'])->name('projetos.store');
    Route::get('/projetos/{id}/editar', [ProjectController::class, 'edit'])->name('projetos.edit');
    Route::put('/projetos/{id}', [ProjectController::class, 'update'])->name('projetos.update');
    Route::delete('/projetos/{id}', [ProjectController::class, 'destroy'])->name('projetos.destroy');

    // Perfil do Usuário
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // Gestão de Usuários (Protegido pelo middleware is_admin)
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/criar', [UserController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
        Route::patch('/usuarios/{id}/status', [UserController::class, 'toggleStatus'])->name('usuarios.toggleStatus');
    });
});
