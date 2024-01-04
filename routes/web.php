<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RegistroPagoController;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::get('/', [dashboardController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/Clientes', [ClientesController::class, 'index'])->name('clientes');
    Route::put('/Clientes/editar/{id}', [ClientesController::class, 'editar'])->name('admin.cliente.editar');
    Route::post('/Clientes/guardar', [ClientesController::class, 'guardar'])->name('admin.cliente.guardar');
    Route::get('/Clientes/eliminar/{id}', [ClientesController::class, 'eliminar'])->name('admin.cliente.eliminar');

    Route::get('/Personal', [PersonalController::class, 'index'])->name('personal');
    Route::put('/Personal/editar/{id}', [PersonalController::class, 'editar'])->name('admin.personal.editar');
    Route::post('/Personal/guardar', [PersonalController::class, 'guardar'])->name('admin.personal.guardar');
    Route::get('/Personal/eliminar/{id}', [PersonalController::class, 'eliminar'])->name('admin.personal.eliminar');

    Route::get('/Reportes-Pago', [RegistroPagoController::class, 'index'])->name('registropago');
});
