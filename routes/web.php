<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index.home')->middleware('auth');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

// Rutas para ajustes
Route::get('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth');

Route::post('/admin/ajustes/create', [App\Http\Controllers\AjusteController::class, 'store'])->name('admin.ajustes.create')->middleware('auth');

// Rutas para roles

Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');

Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');

Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');

Route::get('/admin/rol/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');

Route::put('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');

Route::delete('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

// Rutas para usuarios

Route::get('/admin/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');

Route::get('/admin/usuarios/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');

Route::post('/admin/usuarios/create', [App\Http\Controllers\UserController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');

Route::post('/admin/usuario/{id}/restaurar', [App\Http\Controllers\UserController::class, 'restore'])->name('admin.usuarios.restore')->middleware('auth');

Route::get('/admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');

Route::get('/admin/usuario/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');

Route::put('/admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');

Route::delete('/admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

// Rutas para espacios

Route::get('/admin/espacios', [App\Http\Controllers\EspacioController::class, 'index'])->name('admin.espacios.index')->middleware('auth');

Route::get('/admin/espacios/create', [App\Http\Controllers\EspacioController::class, 'create'])->name('admin.espacios.create')->middleware('auth');

Route::post('/admin/espacios/create', [App\Http\Controllers\EspacioController::class, 'store'])->name('admin.espacios.store')->middleware('auth');

Route::get('/admin/espacio/{id}/edit', [App\Http\Controllers\EspacioController::class, 'edit'])->name('admin.espacios.edit')->middleware('auth');

Route::put('/admin/espacio/{id}', [App\Http\Controllers\EspacioController::class, 'update'])->name('admin.espacios.update')->middleware('auth');

Route::delete('/admin/espacio/{id}', [App\Http\Controllers\EspacioController::class, 'destroy'])->name('admin.espacios.destroy')->middleware('auth');

// Rutas para tarifas

Route::get('/admin/tarifas', [App\Http\Controllers\TarifaController::class, 'index'])->name('admin.tarifas.index')->middleware('auth');

Route::get('/admin/tarifas/create', [App\Http\Controllers\TarifaController::class, 'create'])->name('admin.tarifas.create')->middleware('auth');

Route::post('/admin/tarifas/create', [App\Http\Controllers\TarifaController::class, 'store'])->name('admin.tarifas.store')->middleware('auth');

