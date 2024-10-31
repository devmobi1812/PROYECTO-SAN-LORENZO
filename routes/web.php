<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TurnoController;
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

Route::view("/panel", "panel.index")->name("panel");
Route::view("/login", "auth.login")->name("login");
Route::view("/401", "pages.401")->name("401");
Route::view("/404", "pages.404")->name("404");
Route::view("/500", "pages.500")->name("500");
