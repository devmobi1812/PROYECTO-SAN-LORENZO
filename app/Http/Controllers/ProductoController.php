<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoStoreRequest;
use App\Http\Requests\ProductoUpdateRequest;
use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index',['productos' =>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create', [
            "tiposDeProducto" => TipoProducto::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Producto::create($request->all());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("productos");
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $producto = Producto::with(["tipoProducto"])->findOrFail($id);
            return view('productos.edit', [
                "producto" => $producto,
                "tiposDeProducto" => TipoProducto::all()
            ]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $producto = Producto::findOrFail($id);
            $producto->update($request->all());
            $producto -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("productos");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route("productos");
    }
}
