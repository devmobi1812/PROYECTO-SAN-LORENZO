<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicioStoreRequest;
use App\Models\Servicio;
use App\Models\Turno;
use App\Models\Producto;
use Illuminate\Http\Request;
use Exception;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index',['servicios' =>$servicios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $turnos = Turno::all();
        $productos = Producto::all();
        return view('servicios.create', ['turnos' =>$turnos, 'productos' =>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicioStoreRequest $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $servicio = Servicio::findOrFail($id);
            return view('servicios.edit', ["servicio" => $servicio]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        //
    }
}
