<?php

use App\Http\Controllers\ClienteController;
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
Route::view("/panel", "panel.index")->name("panel");
Route::view("/login", "auth.login")->name("login");
Route::view("/401", "pages.401")->name("401");
Route::view("/404", "pages.404")->name("404");
Route::view("/500", "pages.500")->name("500");
