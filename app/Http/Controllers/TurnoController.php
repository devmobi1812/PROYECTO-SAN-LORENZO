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
        return view('turnos.index');
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
        return redirect()->route("turnos");
    }

    /**
     * Display the specified resource.
     */
    public function show(Turno $turno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Turno $turno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turno $turno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turno $turno)
    {
        //
    }
}
