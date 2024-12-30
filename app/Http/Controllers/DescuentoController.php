<?php

namespace App\Http\Controllers;

use App\Http\Requests\DescuentoStoreRequest;
use App\Http\Requests\DescuentoUpdateRequest;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $descuentos = Descuento::all();
        return view('descuentos.index', ["descuentos" => $descuentos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('descuentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DescuentoStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Descuento::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("descuentos");
    }

    /**
     * Display the specified resource.
     */
    public function show(Descuento $descuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $descuento = Descuento::findOrFail($id);
            return view('descuentos.edit', ["descuento" => $descuento]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DescuentoUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $descuento = Descuento::findOrFail($id);
            $descuento->update($request->all());
            $descuento -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("descuentos");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Descuento::destroy($id);
        return redirect()->route("descuentos");
    }
}
