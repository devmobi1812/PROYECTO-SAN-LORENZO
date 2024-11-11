<?php

namespace App\Http\Controllers;
use App\Http\Requests\MetodoDePagoStoreRequest;
use App\Http\Requests\MetodoDePagoUpdateRequest;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\MetodoDePago;
use Illuminate\Http\Request;

class MetodoDePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metododepagos = MetodoDePago::all();
        return view('metododepagos.index', ["metododepagos" => $metododepagos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metododepagos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetodoDePagoStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            MetodoDePago::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("metododepagos");
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodoDePago $metododepago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $metododepago = MetodoDePago::findOrFail($id);
            return view('metododepagos.edit', ["metododepago" => $metododepago]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetodoDePagoUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $descuento = MetodoDePago::findOrFail($id);
            $descuento->update($request->all());
            $descuento -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("metododepagos");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        MetodoDePago::destroy($id);
        return redirect()->route("metododepagos");
    }
}
