<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ─── Dashboard ─────────────────────────────────────────────────────────────
Route::get('/home',  [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index.home')->middleware(['auth', 'role_or_permission:SUPER ADMIN|ADMINISTRADOR|admin|ver dashboard']);
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware(['auth', 'role_or_permission:SUPER ADMIN|ADMINISTRADOR|admin|ver dashboard']);

Route::middleware('auth')->group(function () {

    // ─── Ajustes ──────────────────────────────────────────────────────────
    Route::middleware(['permission:ver ajustes'])->group(function () {
        Route::get ('/admin/ajustes',        [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index');
    });
    Route::middleware(['permission:editar ajustes'])->group(function () {
        Route::post('/admin/ajustes/create', [App\Http\Controllers\AjusteController::class, 'store'])->name('admin.ajustes.create');
    });

    // ─── Roles ────────────────────────────────────────────────────────────
    Route::middleware(['permission:ver roles'])->get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
    Route::middleware(['permission:crear roles'])->get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create');
    Route::middleware(['permission:crear roles'])->post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
    Route::middleware(['permission:editar roles'])->get('/admin/rol/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::middleware(['permission:editar roles'])->put('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update');
    Route::middleware(['permission:eliminar roles'])->delete('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy');

    // ─── Usuarios ─────────────────────────────────────────────────────────
    Route::middleware(['permission:ver usuarios'])->get('/admin/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index');
    Route::middleware(['permission:ver usuarios'])->get('/admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.usuarios.show');
    Route::middleware(['permission:crear usuarios'])->get('/admin/usuarios/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.usuarios.create');
    Route::middleware(['permission:crear usuarios'])->post('/admin/usuarios/create', [App\Http\Controllers\UserController::class, 'store'])->name('admin.usuarios.store');
    Route::middleware(['permission:editar usuarios'])->get('/admin/usuario/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.usuarios.edit');
    Route::middleware(['permission:editar usuarios'])->put('/admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.usuarios.update');
    Route::middleware(['permission:editar usuarios'])->post('/admin/usuario/{id}/restaurar', [App\Http\Controllers\UserController::class, 'restore'])->name('admin.usuarios.restore');
    Route::middleware(['permission:eliminar usuarios'])->delete('/admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.usuarios.destroy');

    // ─── Espacios ─────────────────────────────────────────────────────────
    Route::middleware(['permission:ver espacios'])->get('/admin/espacios', [App\Http\Controllers\EspacioController::class, 'index'])->name('admin.espacios.index');
    Route::middleware(['permission:crear espacios'])->get('/admin/espacios/create', [App\Http\Controllers\EspacioController::class, 'create'])->name('admin.espacios.create');
    Route::middleware(['permission:crear espacios'])->post('/admin/espacios/create', [App\Http\Controllers\EspacioController::class, 'store'])->name('admin.espacios.store');
    Route::middleware(['permission:editar espacios'])->get('/admin/espacio/{id}/edit', [App\Http\Controllers\EspacioController::class, 'edit'])->name('admin.espacios.edit');
    Route::middleware(['permission:editar espacios'])->put('/admin/espacio/{id}', [App\Http\Controllers\EspacioController::class, 'update'])->name('admin.espacios.update');
    Route::middleware(['permission:eliminar espacios'])->delete('/admin/espacio/{id}', [App\Http\Controllers\EspacioController::class, 'destroy'])->name('admin.espacios.destroy');

    // ─── Clientes ─────────────────────────────────────────────────────────
    Route::middleware(['permission:ver clientes'])->get('/admin/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index');
    Route::middleware(['permission:ver clientes'])->get('/admin/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show');
    Route::middleware(['permission:crear clientes'])->get('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create');
    Route::middleware(['permission:crear clientes'])->post('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store');
    Route::middleware(['permission:editar clientes'])->get('/admin/cliente/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit');
    Route::middleware(['permission:editar clientes'])->put('/admin/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update');
    Route::middleware(['permission:editar clientes'])->post('/admin/cliente/{id}/restaurar', [App\Http\Controllers\ClienteController::class, 'restore'])->name('admin.clientes.restore');
    Route::middleware(['permission:eliminar clientes'])->delete('/admin/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy');

    // ─── Vehículos (vinculados a clientes) ────────────────────────────────
    Route::middleware(['permission:crear vehiculos'])->post('/admin/clientes/vehiculos/create', [App\Http\Controllers\VehiculoController::class, 'store'])->name('admin.clientes.vehiculos.store');
    Route::middleware(['permission:editar vehiculos'])->put('/admin/clientes/vehiculo/{id}', [App\Http\Controllers\VehiculoController::class, 'update'])->name('admin.clientes.vehiculo.update');
    Route::middleware(['permission:eliminar vehiculos'])->delete('/admin/clientes/vehiculo/{id}', [App\Http\Controllers\VehiculoController::class, 'destroy'])->name('admin.clientes.vehiculo.destroy');

    // ─── Tipo de Vehículos ────────────────────────────────────────────────
    Route::middleware(['permission:ver tipo vehiculos'])->get('/admin/tipo-vehiculos', [App\Http\Controllers\TipoVehiculoController::class, 'index'])->name('admin.tipo_vehiculos.index');
    Route::middleware(['permission:crear tipo vehiculos'])->get('/admin/tipo-vehiculos/create', [App\Http\Controllers\TipoVehiculoController::class, 'create'])->name('admin.tipo_vehiculos.create');
    Route::middleware(['permission:crear tipo vehiculos'])->post('/admin/tipo-vehiculos/create', [App\Http\Controllers\TipoVehiculoController::class, 'store'])->name('admin.tipo_vehiculos.store');
    Route::middleware(['permission:editar tipo vehiculos'])->get('/admin/tipo-vehiculo/{id}/edit', [App\Http\Controllers\TipoVehiculoController::class, 'edit'])->name('admin.tipo_vehiculos.edit');
    Route::middleware(['permission:editar tipo vehiculos'])->put('/admin/tipo-vehiculo/{id}', [App\Http\Controllers\TipoVehiculoController::class, 'update'])->name('admin.tipo_vehiculos.update');
    Route::middleware(['permission:eliminar tipo vehiculos'])->delete('/admin/tipo-vehiculo/{id}', [App\Http\Controllers\TipoVehiculoController::class, 'destroy'])->name('admin.tipo_vehiculos.destroy');

    // ─── Tipo de Membresías ───────────────────────────────────────────────
    Route::middleware(['permission:ver tipo membresias'])->get('/admin/tipo-membresias', [App\Http\Controllers\TipoMembresiaController::class, 'index'])->name('admin.tipo_membresias.index');
    Route::middleware(['permission:crear tipo membresias'])->get('/admin/tipo-membresias/create', [App\Http\Controllers\TipoMembresiaController::class, 'create'])->name('admin.tipo_membresias.create');
    Route::middleware(['permission:crear tipo membresias'])->post('/admin/tipo-membresias/create', [App\Http\Controllers\TipoMembresiaController::class, 'store'])->name('admin.tipo_membresias.store');
    Route::middleware(['permission:editar tipo membresias'])->get('/admin/tipo-membresia/{id}/edit', [App\Http\Controllers\TipoMembresiaController::class, 'edit'])->name('admin.tipo_membresias.edit');
    Route::middleware(['permission:editar tipo membresias'])->put('/admin/tipo-membresia/{id}', [App\Http\Controllers\TipoMembresiaController::class, 'update'])->name('admin.tipo_membresias.update');
    Route::middleware(['permission:eliminar tipo membresias'])->delete('/admin/tipo-membresia/{id}', [App\Http\Controllers\TipoMembresiaController::class, 'destroy'])->name('admin.tipo_membresias.destroy');

    // ─── Membresías ───────────────────────────────────────────────────────
    Route::middleware(['permission:ver membresias'])->get('/admin/membresias', [App\Http\Controllers\MembresiaController::class, 'index'])->name('admin.membresias.index');
    Route::middleware(['permission:ver membresias'])->get('/admin/membresia/{id}', [App\Http\Controllers\MembresiaController::class, 'show'])->name('admin.membresias.show');
    Route::middleware(['permission:crear membresias'])->get('/admin/membresias/create', [App\Http\Controllers\MembresiaController::class, 'create'])->name('admin.membresias.create');
    Route::middleware(['permission:crear membresias'])->post('/admin/membresias/create', [App\Http\Controllers\MembresiaController::class, 'store'])->name('admin.membresias.store');
    Route::middleware(['permission:editar membresias'])->get('/admin/membresia/{id}/edit', [App\Http\Controllers\MembresiaController::class, 'edit'])->name('admin.membresias.edit');
    Route::middleware(['permission:editar membresias'])->put('/admin/membresia/{id}', [App\Http\Controllers\MembresiaController::class, 'update'])->name('admin.membresias.update');
    Route::middleware(['permission:eliminar membresias'])->delete('/admin/membresia/{id}', [App\Http\Controllers\MembresiaController::class, 'destroy'])->name('admin.membresias.destroy');

    // ─── Ingreso de Vehículos ─────────────────────────────────────────────
    Route::middleware(['permission:ver ingresos'])->get('/admin/ingresos', [App\Http\Controllers\IngresoVehiculoController::class, 'index'])->name('admin.ingreso_vehiculos.index');
    Route::middleware(['permission:ver ingresos'])->get('/admin/ingreso/{id}', [App\Http\Controllers\IngresoVehiculoController::class, 'show'])->name('admin.ingreso_vehiculos.show');
    Route::middleware(['permission:ver ingresos'])->get('/admin/ingresos/buscar/{placa}', [App\Http\Controllers\IngresoVehiculoController::class, 'buscarVehiculo'])->name('admin.ingreso_vehiculos.buscar');
    Route::middleware(['permission:crear ingresos'])->get('/admin/ingresos/create', [App\Http\Controllers\IngresoVehiculoController::class, 'create'])->name('admin.ingreso_vehiculos.create');
    Route::middleware(['permission:crear ingresos'])->post('/admin/ingresos/create', [App\Http\Controllers\IngresoVehiculoController::class, 'store'])->name('admin.ingreso_vehiculos.store');
    Route::middleware(['permission:eliminar ingresos'])->delete('/admin/ingreso/{id}', [App\Http\Controllers\IngresoVehiculoController::class, 'destroy'])->name('admin.ingreso_vehiculos.destroy');

    // ─── Salida de Vehículos ──────────────────────────────────────────────
    Route::middleware(['permission:ver salidas'])->get('/admin/salidas', [App\Http\Controllers\SalidaVehiculoController::class, 'index'])->name('admin.salida_vehiculos.index');
    Route::middleware(['permission:ver salidas'])->get('/admin/salida/{id}', [App\Http\Controllers\SalidaVehiculoController::class, 'show'])->name('admin.salida_vehiculos.show');
    Route::middleware(['permission:crear salidas'])->get('/admin/salidas/create', [App\Http\Controllers\SalidaVehiculoController::class, 'create'])->name('admin.salida_vehiculos.create');
    Route::middleware(['permission:crear salidas'])->post('/admin/salidas/create', [App\Http\Controllers\SalidaVehiculoController::class, 'store'])->name('admin.salida_vehiculos.store');

    // ─── Métodos de Pago ──────────────────────────────────────────────────
    Route::middleware(['permission:ver metodos pago'])->get('/admin/metodo-pagos', [App\Http\Controllers\MetodoPagoController::class, 'index'])->name('admin.metodo_pagos.index');
    Route::middleware(['permission:crear metodos pago'])->get('/admin/metodo-pagos/create', [App\Http\Controllers\MetodoPagoController::class, 'create'])->name('admin.metodo_pagos.create');
    Route::middleware(['permission:crear metodos pago'])->post('/admin/metodo-pagos/create', [App\Http\Controllers\MetodoPagoController::class, 'store'])->name('admin.metodo_pagos.store');
    Route::middleware(['permission:editar metodos pago'])->get('/admin/metodo-pago/{id}/edit', [App\Http\Controllers\MetodoPagoController::class, 'edit'])->name('admin.metodo_pagos.edit');
    Route::middleware(['permission:editar metodos pago'])->put('/admin/metodo-pago/{id}', [App\Http\Controllers\MetodoPagoController::class, 'update'])->name('admin.metodo_pagos.update');
    Route::middleware(['permission:eliminar metodos pago'])->delete('/admin/metodo-pago/{id}', [App\Http\Controllers\MetodoPagoController::class, 'destroy'])->name('admin.metodo_pagos.destroy');

    // ─── Pagos ────────────────────────────────────────────────────────────
    Route::middleware(['permission:ver pagos'])->get('/admin/pagos', [App\Http\Controllers\PagoController::class, 'index'])->name('admin.pagos.index');
    Route::middleware(['permission:ver pagos'])->get('/admin/pago/{id}', [App\Http\Controllers\PagoController::class, 'show'])->name('admin.pagos.show');
    Route::middleware(['permission:crear pagos'])->get('/admin/pagos/create', [App\Http\Controllers\PagoController::class, 'create'])->name('admin.pagos.create');
    Route::middleware(['permission:crear pagos'])->post('/admin/pagos/create', [App\Http\Controllers\PagoController::class, 'store'])->name('admin.pagos.store');
    Route::middleware(['permission:eliminar pagos'])->delete('/admin/pago/{id}', [App\Http\Controllers\PagoController::class, 'destroy'])->name('admin.pagos.destroy');

    // ─── Bitácora ─────────────────────────────────────────────────────────
    Route::middleware(['permission:ver bitacora'])->get('/admin/bitacoras', [App\Http\Controllers\BitacoraController::class, 'index'])->name('admin.bitacoras.index');
    Route::middleware(['permission:ver bitacora'])->get('/admin/bitacora/{id}', [App\Http\Controllers\BitacoraController::class, 'show'])->name('admin.bitacoras.show');
    Route::middleware(['permission:eliminar bitacora'])->delete('/admin/bitacora/{id}', [App\Http\Controllers\BitacoraController::class, 'destroy'])->name('admin.bitacoras.destroy');
    Route::middleware(['permission:limpiar bitacora'])->delete('/admin/bitacoras/limpiar', [App\Http\Controllers\BitacoraController::class, 'destroyAll'])->name('admin.bitacoras.destroyAll');
});
