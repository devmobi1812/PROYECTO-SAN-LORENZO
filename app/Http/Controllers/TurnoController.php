<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurnoStoreRequest;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turnos = Turno::all();
        return view('turnos.index', ["turnos" => $turnos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('turnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TurnoStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Turno::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route(route: "turnos");
    }

    /**
     * Display the specified resource.
     */
    public function show(Turno $turno)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $turno = Turno::findOrFail($id);
            return view('turnos.edit', ["turno" => $turno]);
        }catch(Exception $e){
            return redirect()->route("404");
        }    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TurnoStoreRequest $request,$id)
    {
        try{
            DB::beginTransaction();

            $estudiante = Turno::findOrFail($id);
            $estudiante->update($request->all());
            $estudiante -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("turnos");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Turno::destroy($id);
        return redirect()->route("turnos");
    }
}
