<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TareaController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('tareas.index') : view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::resource('categorias', CategoriaController::class);
    Route::resource('tareas', TareaController::class);

    Route::resource('tareas', TareaController::class);

    Route::post('/tareas/{id}/subtareas', [App\Http\Controllers\SubtareaController::class, 'store'])->name('subtareas.store');
    Route::patch('/subtareas/{id}', [App\Http\Controllers\SubtareaController::class, 'update'])->name('subtareas.update');
    Route::delete('/subtareas/{id}', [App\Http\Controllers\SubtareaController::class, 'destroy'])->name('subtareas.destroy');

    Route::post('/tareas/{id}/comentarios', [App\Http\Controllers\ComentarioController::class, 'store'])->name('comentarios.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';