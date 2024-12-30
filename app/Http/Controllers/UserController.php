<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view("usuarios.index", ["usuarios" => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("usuarios.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $datos = $request->all();
            unset($datos['password2']);
            $datos['password'] = Hash::make($datos['password']);
            User::create($datos);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route(route: "usuarios");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $usuario = User::findOrFail($id);
            return view('usuarios.edit', ["usuario" => $usuario]);
        }catch(Exception $e){
            return redirect()->route("404");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request,$id)
    {
        try{
            DB::beginTransaction();

            $usuario = User::findOrFail($id);
            $datos = $request->all();
            if (!empty($datos['password'])) {
                $datos['password'] = Hash::make($datos['password']);
            } else {
                unset($datos['password']);
            }
            unset($datos['password2']);
            $usuario->update($datos);
            $usuario -> save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("usuarios");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //TODO: si borra su propio usuario que cierre sesión o  no dejarte, preferiblemente la segunda
        User::destroy($id);
        return redirect()->route("usuarios");
    }
}
