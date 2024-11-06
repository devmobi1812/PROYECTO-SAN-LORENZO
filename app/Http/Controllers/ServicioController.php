<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicioStoreRequest;
use App\Http\Requests\ServicioUpdateRequest;
use App\Models\Servicio;
use App\Models\Turno;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::with(["turno", "producto"])->get();
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
        try{
            DB::beginTransaction();
            Servicio::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("servicios");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $turnos = Turno::all();
            $servicio = Servicio::findOrFail($id);
            $productos = Producto::all();
            return view('servicios.edit', ["servicio" => $servicio, "turnos"=> $turnos, 'productos' =>$productos]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicioUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $servicio = Servicio::findOrFail($id);
            $servicio->update($request->all());
            $servicio -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("servicios");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Servicio::destroy($id);
        return redirect()->route("servicios");
    }
}
