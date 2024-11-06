<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlquilerReciboStoreRequest;
use App\Http\Requests\AlquilerReciboUpdateRequest;
use App\Models\Alquilere;
use App\Models\Alquiler_recibo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AlquilerReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $recibos = Alquiler_recibo::with('alquiler')->get();       
        return view('alquiler.recibos.index', ['recibos'=>$recibos]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                  
        return view("alquiler.recibos.create");
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlquilerReciboStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Alquiler_recibo::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("recibos");
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Alquiler_recibo $alquiler_recibo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $recibo = Alquiler_recibo::findOrFail($id);
            return view('alquiler.recibos.edit', ["recibo" => $recibo]);
        } catch (Exception $e) {
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlquilerReciboUpdateRequest $request,$id)
    {

        try {
            DB::beginTransaction();

            $recibo = Alquiler_recibo::findOrFail($id);
            $recibo->update($request->all());
            $recibo -> save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route("recibos");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alquiler_recibo::destroy($id);
        return redirect()->route("recibos");
    }
}
