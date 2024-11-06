<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlquilerAbonoRequest;
use App\Http\Requests\AlquilerAbonoUpdateRequest;
use App\Models\Alquiler_abono;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AlquilerAbonoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abonos = Alquiler_abono::with(["alquiler", "metodoDePago"])->get();
        /*$abonos=Alquiler_abono::join("metodo_de_pagos as metodo","alquiler_abonos.metodo_de_pagos_id","=","metodo_de_pagos.id")
                                ->join("alquileres","alquiler_abonos.alquiler_id","=","alquileres.id")
                                ->select("alquiler_abonos.id as abono_id",
                                        "alquiler_abonos.monto_pagado as abono_monto",
                                        "alquiler_abonos.metodo_de_pagos_id as abono_metodo",
                                        "alquiler_abono.alquiler_id as abono_alquiler")
                                ->get();*/
        return view("alquiler.abonos.index", ["abonos"=>$abonos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $metodos=MetodoDePago::all();
        return view("alquiler.abonos.create", ["metodos"=>$metodos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlquilerAbonoRequest $request)
    {
        try{
            DB::beginTransaction();
            Alquiler_abono::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("alquiler.abonos");
    }

    /**
     * Display the specified resource.
     */
    public function show(Alquiler_abono $alquiler_abono)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alquiler_abono $alquiler_abono)
    {
        try{
            $metodos = MetodoDePago::all();
            return view("alquiler.abono.edit", ["metodos"=>$metodos]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlquilerAbonoUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $abono = Alquiler_abono::findOrFail($id);
            $abono->update($request->all());
            $abono -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("abonos");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encuentra el abono a eliminar
        $abono = Alquiler_abono::findOrFail($id);

        // Encuentra el alquiler asociado al abono
        $alquiler = $abono->alquiler;

        // Suma el monto del abono al monto total del alquiler
        $alquiler->monto_total += $abono->monto_pagado;
        $alquiler->save();

        Alquiler_abono::destroy($id);
        return redirect()->route("abonos");
    }

}
