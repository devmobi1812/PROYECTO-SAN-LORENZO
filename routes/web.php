<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\AlquilerAbonoController;
use App\Http\Controllers\AlquilerReciboController;
use App\Http\Controllers\AlquilereController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});
Route::controller(ClienteController::class)->group( function(){
    Route::get("clientes", "index")->name("clientes");
    Route::get("clientes/crear", "create")->name("cliente-crear");
    Route::post("clientes/guardar", "store")->name("cliente-guardar");
    Route::get("clientes/mostrar/{id}", "show")->name("cliente-mostrar");
    Route::get("clientes/editar/{id}", "edit")->name("cliente-editar");
    Route::post("clientes/actualizar/{id}", "update")->name("cliente-actualizar");
    Route::get("clientes/eliminar/{id}", "destroy")->name("cliente-borrar");
});

Route::controller(TurnoController::class)->group( function(){
    Route::get("turnos", "index")->name("turnos");
    Route::get("turnos/crear", "create")->name("turno-crear");
    Route::post("turnos/guardar", "store")->name("turno-guardar");
    Route::get("turnos/mostrar/{id}", "show")->name("turno-mostrar");
    Route::get("turnos/editar/{id}", "edit")->name("turno-editar");
    Route::post("turnos/actualizar/{id}", "update")->name("turno-actualizar");
    Route::get("turnos/eliminar/{id}", "destroy")->name("turno-borrar");
});

Route::controller(ProductoController::class)->group( function(){
    Route::get("productos","index")->name("productos");
    Route::get("productos/crear", "create")->name("producto-crear");
    Route::post("productos/guardar", "store")->name("producto-guardar");
    Route::get("productos/mostrar/{id}", "show")->name("producto-mostrar");
    Route::get("productos/editar/{id}", "edit")->name("producto-editar");
    Route::post("productos/actualizar/{id}", "update")->name("producto-actualizar");
    Route::get("productos/eliminar/{id}", "destroy")->name("producto-borrar");
});

Route::controller(ServicioController::class)->group( function(){
    Route::get("servicios", "index")->name("servicios");
    Route::get("servicios/crear", "create")->name("servicio-crear");
    Route::post("servicios/guardar", "store")->name("servicio-guardar");
    Route::get("servicios/editar/{id}", "edit")->name("servicio-editar");
    Route::post("servicios/actualizar/{id}", "update")->name("servicio-actualizar");
    Route::get("servicios/eliminar/{id}", "destroy")->name("servicio-borrar");
});

Route::controller(DescuentoController::class)->group( function(){
    Route::get("descuentos", "index")->name("descuentos");
    Route::get("descuentos/crear", "create")->name("descuento-crear");
    Route::post("descuentos/guardar", "store")->name("descuento-guardar");
    Route::get("descuentos/mostrar/{id}", "show")->name("descuento-mostrar");
    Route::get("descuentos/editar/{id}", "edit")->name("descuento-editar");
    Route::post("descuentos/actualizar/{id}", "update")->name("descuento-actualizar");
    Route::get("descuentos/eliminar/{id}", "destroy")->name("descuento-borrar");
});

Route::controller(DepositoController::class)->group( function(){
    Route::get("depositos", "index")->name("depositos");
    Route::get("depositos/crear", "create")->name("deposito-crear");
    Route::post("depositos/guardar", "store")->name("deposito-guardar");
    Route::get("depositos/mostrar/{id}", "show")->name("deposito-mostrar");
    Route::get("depositos/editar/{id}", "edit")->name("deposito-editar");
    Route::post("depositos/actualizar/{id}", "update")->name("deposito-actualizar");
    Route::get("depositos/eliminar/{id}", "destroy")->name("deposito-borrar");
});

Route::controller(AlquilerAbonoController::class)->group( function(){
    Route::get("abonos", "index")->name("abonos");
    Route::get("abonos/crear", "create")->name("abono-crear");
    Route::post("abonos/guardar", "store")->name("abono-guardar");
    Route::get("abonos/editar/{id}", "edit")->name("abono-editar");
    Route::post("abonos/actualizar/{id}", "update")->name("abono-actualizar");
    Route::get("abonos/eliminar/{id}", "destroy")->name("abono-borrar");
});

Route::controller(AlquilerReciboController::class)->group( function(){
    Route::get("recibos", "index")->name("recibos");
    Route::get("recibos/crear", "create")->name("recibo-crear");
    Route::post("recibos/guardar", "store")->name("recibo-guardar");
    Route::get("recibos/editar/{id}", "edit")->name("recibo-editar");
    Route::post("recibos/actualizar/{id}", "update")->name("recibo-actualizar");
    Route::get("recibos/eliminar/{id}", "destroy")->name("recibo-borrar");
});

Route::controller(AlquilereController::class)->group( function(){
    Route::get("alquileres", "index")->name("alquileres");
    Route::get("alquileres/crear", "create")->name("alquiler-crear");
    Route::post("alquileres/guardar", "store")->name("alquiler-guardar");
    Route::get("alquileres/editar/{id}", "edit")->name("alquiler-editar");
    Route::post("alquileres/actualizar/{id}", "update")->name("alquiler-actualizar");
    Route::get("alquileres/eliminar/{id}", "destroy")->name("alquiler-borrar");
});

Route::controller(UserController::class)->group( function(){
    Route::get("usuarios", "index")->name("usuarios");
    Route::get("usuarios/crear", "create")->name("usuario-crear");
    Route::post("usuarios/guardar", "store")->name("usuario-guardar");
    Route::get("usuarios/editar/{id}", "edit")->name("usuario-editar");
    Route::post("usuarios/actualizar/{id}", "update")->name("usuario-actualizar");
    Route::get("usuarios/eliminar/{id}", "destroy")->name("usuario-borrar");
});

Route::controller(loginController::class)->group( function(){
    Route::get("login", "index")->name("login");
    Route::post("login", "login")->name("login");
    Route::get("logout", "logout")->name("logout");
});
Route::view("/panel", "panel.index")->name("panel");

Route::view("/401", "pages.401")->name("401");
Route::view("/404", "pages.404")->name("404");
Route::view("/500", "pages.500")->name("500");
