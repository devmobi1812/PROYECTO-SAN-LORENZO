<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Auth;
use Illuminate\Http\Request;
use Session;
class loginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect()->route("alquileres");
        }
        return view("auth.login");
    }

    public function login(loginRequest $request){
        if(!Auth::attempt($request->only("email", "password"), $request->filled("remember"))){
            return redirect()->to("login")->withErrors("Credenciales incorrectas");
        }

        return redirect()->to("alquileres");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route("login");
    }
}
