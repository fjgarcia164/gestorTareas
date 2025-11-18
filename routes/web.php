<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return redirect()->route('tareas.index');
});

Route::resource('categorias', CategoriaController::class);
Route::resource('tareas', App\Http\Controllers\TareaController::class);