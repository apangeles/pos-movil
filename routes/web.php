<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AfectacionTipoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadController;
use App\Models\Unidad;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
Route::get('/usuarios/select', [UserController::class, 'usuarios'])->name('usuarios.select');

Route::resource('unidades', UnidadController::class)->except(['create', 'edit']);
Route::resource('productos', ProductoController::class)->except(['create', 'edit']);
Route::resource('roles', RoleController::class)->except(['create', 'edit']);
Route::resource('usuarios', UserController::class)->except(['create', 'edit']);
