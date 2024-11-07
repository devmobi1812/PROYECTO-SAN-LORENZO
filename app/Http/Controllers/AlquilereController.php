<?php

namespace App\Http\Controllers;

use App\Models\Alquilere;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Deposito;
use Illuminate\Http\Request;

class AlquilereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alquileres = Alquilere::all();
        return view('alquiler.alquileres.index',['alquileres' =>$alquileres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $quinchos = Servicio::where('producto_id', 1)->get();
        $pileta = Servicio::where('producto_id', 2)->get();
        $deposito = Deposito::all();

        return view("alquiler.alquileres.create", ["clientes"=>$clientes, "quinchos"=>$quinchos, "piletas"=>$pileta, "depositos"=>$deposito]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alquilere $alquilere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alquilere $alquilere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alquilere $alquilere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alquilere $alquilere)
    {
        //
    }
}
