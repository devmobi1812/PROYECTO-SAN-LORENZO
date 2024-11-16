<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlquilerAbonoRequest;
use App\Http\Requests\AlquilerAbonoUpdateRequest;
use App\Models\Alquiler_abono;
use App\Models\Alquilere;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AlquilerAbonoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $abonos = Alquiler_abono::with(["alquiler", "metodoDePago"])->where("alquiler_id","=",$id)->get();
        /*$abonos=Alquiler_abono::join("metodo_de_pagos as metodo","alquiler_abonos.metodo_de_pagos_id","=","metodo_de_pagos.id")
                                ->join("alquileres","alquiler_abonos.alquiler_id","=","alquileres.id")
                                ->select("alquiler_abonos.id as abono_id",
                                        "alquiler_abonos.monto_pagado as abono_monto",
                                        "alquiler_abonos.metodo_de_pagos_id as abono_metodo",
                                        "alquiler_abono.alquiler_id as abono_alquiler")
                                ->get();*/
        //return view("alquiler.abonos.index", ["abonos"=>$abonos]);
        return view('alquiler.abonos.index', ['abonos' => $abonos, 'alquiler_id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $metodos=MetodoDePago::all();
        return view("alquiler.abonos.create", ["metodos"=>$metodos, 'alquiler_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlquilerAbonoRequest $request)
    {
        
        try{
            DB::beginTransaction();
            $alquilerAbono = Alquiler_abono::with("alquiler")->create(attributes: $request->all());
            $alquiler = $alquilerAbono->alquiler;
            $monto=$alquiler->monto_adeudado;

            $monto-=$request->monto_pagado;

            $alquiler->monto_adeudado = $monto;

            $alquiler->estado_id = $alquiler->monto_adeudado <= 0 ? 1 : 2;

            $alquiler -> save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
        return redirect()->route("alquiler-ver", $request->alquiler_id);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $abono = Alquiler_abono::findOrFail($id);
            $metodos = MetodoDePago::all();
            return view("alquiler.abonos.edit", ["abono"=>$abono,"metodos"=>$metodos]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlquilerAbonoUpdateRequest $request, $id)
    {       
        try {
            DB::beginTransaction();

            $abono = Alquiler_abono::with(["alquiler"])->findOrFail($id);
            $alquiler = $abono->alquiler;

            $montoPagadoAnterior = $abono->monto_pagado;

            $abono->update($request->all());

            $diferenciaPagado = $abono->monto_pagado - $montoPagadoAnterior;

            $alquiler->monto_adeudado -= $diferenciaPagado;

            $alquiler->estado_id = $alquiler->monto_adeudado <= 0 ? 1 : 2;

            $alquiler->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route("alquiler-ver", $alquiler->id);
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
        $alquiler->monto_adeudado+= $abono->monto_pagado;
        $alquiler->estado_id = $alquiler->monto_adeudado <= 0 ? 1 : 2;
        $alquiler->save();

        Alquiler_abono::destroy($id);
        return redirect()->route("alquiler-ver", $alquiler->id);
    }

}
