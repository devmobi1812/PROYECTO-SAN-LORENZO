<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositoStoreRequest;
use App\Http\Requests\DepositoUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Deposito;
use Illuminate\Http\Request;
use Exception;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depositos = Deposito::all();
        return view('depositos.index', ["depositos" => $depositos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depositos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepositoStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Deposito::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("depositos");
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposito $deposito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $deposito = Deposito::findOrFail($id);
            return view('depositos.edit', ["deposito" => $deposito]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepositoUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $descuento = Deposito::findOrFail($id);
            $descuento->update($request->all());
            $descuento -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("depositos");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Deposito::destroy($id);
        return redirect()->route("depositos");
    }
}
