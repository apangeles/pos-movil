<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UnidadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('plantilla.item');
});

Route::resource('unidades', UnidadController::class);
