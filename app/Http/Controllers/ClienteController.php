<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\DB;
use Exception;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clients.index',['clientes' =>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Cliente::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("clientes");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            return view('clients.edit', ["cliente" => $cliente]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $estudiante = Cliente::findOrFail($id);
            $estudiante->update($request->all());
            $estudiante -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("clientes");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
