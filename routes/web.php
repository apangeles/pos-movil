<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AfectacionTipoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadController;
use App\Models\Unidad;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('plantilla.item');
});

Route::get('/afectacion-tipos/select', [AfectacionTipoController::class, 'select'])->name('afectacion-tipos.select');
Route::get('/unidades/select', [UnidadController::class, 'select'])->name('unidades.select');
Route::get('/permisos/select', [RoleController::class, 'permisos'])->name('permisos.select');
Route::get('/roles/select', [RoleController::class, 'roles'])->name('roles.select');

Route::resource('unidades', UnidadController::class)->except(['create', 'edit']);
Route::resource('productos', ProductoController::class)->except(['create', 'edit']);
Route::resource('roles', RoleController::class)->except(['create', 'edit']);
Route::resource('usuarios', UserController::class)->except(['create', 'edit']);

Route::get('login', function(){
    return view('autenticacion.login');
})->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('dashboard', function(){
    return view('dashboard.index');
})->name('dashboard');