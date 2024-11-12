<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlquilerStoreRequest;
use App\Http\Requests\AlquilerUpdateRequest;
use App\Http\Requests\AlquilerAbonoRequest;
use App\Http\Controllers\AlquilerAbonoController;
use App\Models\Alquilere;
use App\Models\Alquiler_recibo;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Deposito;
use App\Models\Descuento;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AlquilereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alquileres = Alquilere::with(['estado', 'descuento', 'cliente'])->get();
        $servicios = Alquiler_recibo::all();
        //dd($alquileres);
        return view('alquiler.alquileres.index',['alquileres' =>$alquileres, 'servicios'=>$servicios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $nombreProducto="Quincho";
        $quinchos = Servicio::whereHas('producto', function ($query) use ($nombreProducto) { $query->where('nombre', $nombreProducto); })->get();
        
        $pileta = Servicio::whereHas('producto', function ($query) use ($nombreProducto) { $query->where('nombre', $nombreProducto); })->get();
        $pileta = Servicio::where('producto_id', 2)->get();
        $vajilla = Servicio::where('producto_id', 3)->get();
        $deposito = Deposito::all();
        $descuentos = Descuento::all();
        $metodos=MetodoDePago::all();

        return view("alquiler.alquileres.create", ["clientes"=>$clientes, "quinchos"=>$quinchos, "pileta"=>$pileta, "vajilla"=>$vajilla,"depositos"=>$deposito, "descuentos"=>$descuentos, "metodos"=>$metodos]);
    }

    /**
     * Store a newly created resource in storage.
     */

    private function getDayOfWeek($fecha) {
        $date = new \DateTime($fecha);
        $dayOfWeek = $date->format('N'); // 'N' devuelve el día de la semana en el rango de 1 (lunes) a 7 (domingo)
    
        // Ajustar para que 1 sea domingo y 7 sea sábado
        return $dayOfWeek == 7 ? 1 : $dayOfWeek + 1;
    }
    
    public function store(AlquilerStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $dia = $this->getDayOfWeek($request->fecha);

            $alquiler = Alquilere::create([ 
                'nombre_id' => $request->nombre_id, 
                'dia_id' => $dia, 
                'descuento_id' => $request->descuento_id, 
                'estado_id' => 2,//es inpago 
                'monto_final' => 0, // Se actualizará más adelante 
                'monto_adeudado' => 0, // Inicialmente en 0 
                'deposito' => $request->deposito, 
                'fecha' => $request->fecha ]); 
            DB::commit();

            $ultimoRegistro = Alquilere::orderBy('id', 'desc')->select("id", "deposito")->first();
            if($ultimoRegistro!=null){
                // Crear los recibos y calcular el monto final 
                DB::beginTransaction();
                $montoFinal = 0;
                $descuento_id = $request->descuento_id;
                $descuento= Descuento::where("id",$descuento_id)->first();
                $montoQuincho=0;
                $montoVajilla=0;
                $montoPileta=0;
                $deposito=$ultimoRegistro->deposito;
                
                if($request->quincho==1){
                    $servicio = Servicio::with(['turno', 'producto'])->where("id", $request->quincho_id)->first();
                    //$servicio = Servicio::where('id', $request->quincho_id)->first();
                    $recibo = Alquiler_recibo::create([
                        'alquiler_id' => $ultimoRegistro->id,
                        'servicio_nombre'=>$servicio->nombre,
                        'servicio_precio'=>$servicio->precio,
                        'servicio_cantidad'=>1,
                        'desde'=>$servicio->turno->desde,
                        'hasta'=>$servicio->turno->hasta

                        
                    ]);
                    $montoQuincho= $recibo->servicio_precio; 
                }
                
                if($request->vajilla==1){
                    
                    $servicio = Servicio::where('producto_id', 3)->first();
                    //dd($servicio);
                    $recibo = Alquiler_recibo::create([
                        'alquiler_id' => $ultimoRegistro->id,
                        'servicio_nombre'=>$servicio->nombre,
                        'servicio_precio'=>$servicio->precio,
                        'servicio_cantidad'=>$request->servicio_cantidad,
                        
                    ]);
                    $montoVajilla= $recibo->servicio_precio * $recibo->servicio_cantidad;
                }
                if($request->pileta==1){
                    $servicio = Servicio::where('producto_id', 2)->first();
                    $recibo = Alquiler_recibo::create([
                        'alquiler_id' => $ultimoRegistro->id,
                        'servicio_nombre'=>$servicio->nombre,
                        'servicio_precio'=>$servicio->precio,
                        'servicio_cantidad'=>1,
                        'desde'=>$request->desde,
                        'hasta'=>$request->hasta
                    ]);

                    // Convertir los tiempos a DateTime
                    $desde = new \DateTime($recibo->desde);
                    $hasta = new \DateTime($recibo->hasta);

                    // Calcular la diferencia
                    $intervalo = $desde->diff($hasta);

                    $montoPileta= $recibo->servicio_precio *$intervalo->h;
                }

                $montoFinal=$montoQuincho+$montoVajilla+$montoPileta;
                
                $montoDescuento=(($montoFinal*$descuento->cantidad)/100);
                //dd($descuento);
                $montoFinal=($montoFinal-$montoDescuento)+$deposito;
                
                // Actualizar el monto final del alquiler 
                $ultimoRegistro->update(['monto_final' => $montoFinal]); 
                $ultimoRegistro->update(['monto_adeudado' => $montoFinal]);

                if ($request->seña == 1) {
                    $datosAbono = [
                        'alquiler_id' => $ultimoRegistro->id,
                        'monto_pagado' => $montoFinal / 2,
                        'metodo_de_pagos_id' => $request->metodo_de_pagos_id
                    ];
                
                    $alquilerAbonoRequest = new AlquilerAbonoRequest();
                    $alquilerAbonoRequest->replace($datosAbono);

                    $abonoController = new AlquilerAbonoController();
                    $abonoController->store($alquilerAbonoRequest);
                }
                
                
                DB::commit();
            }
            
        }catch(Exception $e){
            DB::rollBack();
            print($e);
        }
        
            //return $this->index();
            return redirect()->route("alquileres");
            //return redirect()->back()->with('success', 'Alquiler creado exitosamente.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Alquilere $alquilere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $alquiler = Alquilere::findOrFail($id);

            $clientes = Cliente::all();
            $nombreProducto = "Quincho";
            $quinchos = Servicio::whereHas('producto', function ($query) use ($nombreProducto) {
                $query->where('nombre', $nombreProducto);})->get();
            $pileta = Servicio::where('producto_id', 2)->get();
            $vajilla = Servicio::where('producto_id', 3)->get();
            $deposito = Deposito::all();
            $descuentos = Descuento::all();
            $metodos=MetodoDePago::all();

            return view("alquiler.alquileres.edit", [
                "alquiler" => $alquiler,
                "clientes" => $clientes,
                "quinchos" => $quinchos,
                "pileta" => $pileta,
                "vajilla" => $vajilla,
                "depositos" => $deposito,
                "descuentos" => $descuentos,
                "metodos"=>$metodos
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            
        }

        return redirect()->route("alquileres");
    }
    

    

    /**
     * Update the specified resource in storage.
     */
    public function update(AlquilerUpdateRequest $request, $id)
{   
    try {
        DB::beginTransaction();
        
        $alquiler = Alquilere::findOrFail($id);
       
        $dia = $this->getDayOfWeek($request->fecha);
        $alquiler->update([
            'nombre_id' => $request->nombre_id,
            'dia_id' => $dia,
            'descuento_id' => $request->descuento_id,
            'deposito' => $request->deposito,
            'fecha' => $request->fecha,
            'estado_id' => 2, 
        ]);        

        $montoFinal = 0;
        $descuento_id = $request->descuento_id;
        $descuento = Descuento::where('id', $descuento_id)->first();
        $montoQuincho = 0;
        $montoVajilla = 0;
        $montoPileta = 0;
        $deposito = $alquiler->deposito;

        $alquiler->alquilerRecibos()->delete();

        if ($request->quincho == 1) {
            $servicio = Servicio::where('id', $request->quincho_id)->first();
            $recibo = Alquiler_recibo::updateOrCreate(
                ['alquiler_id' => $alquiler->id, 'servicio_nombre' => $servicio->nombre],
                ['servicio_precio' => $servicio->precio, 'servicio_cantidad' => 1]
            );
            $montoQuincho = $recibo->servicio_precio;
        }

        if ($request->vajilla == 1) {
            $servicio = Servicio::where('producto_id', 3)->first();
            $recibo = Alquiler_recibo::updateOrCreate(
                ['alquiler_id' => $alquiler->id, 'servicio_nombre' => $servicio->nombre],
                ['servicio_precio' => $servicio->precio, 'servicio_cantidad' => $request->servicio_cantidad]
            );
            $montoVajilla = $recibo->servicio_precio * $recibo->servicio_cantidad;
        }

        if ($request->pileta == 1) {
            $servicio = Servicio::where('producto_id', 2)->first();
            $recibo = Alquiler_recibo::updateOrCreate(
                ['alquiler_id' => $alquiler->id, 'servicio_nombre' => $servicio->nombre],
                [
                    'servicio_precio' => $servicio->precio,
                    'servicio_cantidad' => 1,
                    'desde' => $request->desde,
                    'hasta' => $request->hasta
                ]
            );           
            $desde = new \DateTime($recibo->desde);
            $hasta = new \DateTime($recibo->hasta);
            $intervalo = $desde->diff($hasta);
            $montoPileta = $recibo->servicio_precio * $intervalo->h;
        }

        $montoFinal = $montoQuincho + $montoVajilla + $montoPileta;
        $montoDescuento = (($montoFinal * $descuento->cantidad) / 100);
        $montoFinal = ($montoFinal - $montoDescuento) + $deposito;
        
        $alquiler->update([
            'monto_final' => $montoFinal,
            'monto_adeudado' => $montoFinal
        ]);

        DB::commit();
        return redirect()->route("alquileres");

        
    } catch (Exception $e) {
        DB::rollBack();
         $e->getMessage();
    }
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alquilere::destroy($id);
        return redirect()->route("alquileres");
    }
}
