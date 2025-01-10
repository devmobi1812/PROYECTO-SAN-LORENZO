<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlquilerStoreRequest;
use App\Http\Requests\AlquilerUpdateRequest;
use App\Http\Requests\AlquilerAbonoRequest;
use App\Http\Controllers\AlquilerAbonoController;
use App\Models\Alquiler_abono;
use App\Models\Alquilere;
use App\Models\Alquiler_recibo;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Estado;
use App\Models\Servicio;
use App\Models\Deposito;
use App\Models\Descuento;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class AlquilereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alquileres = Alquilere::with(['estadoAlquiler', 'cliente', 'estadoDeposito'])->whereDate('fecha', '>=', Carbon::today())->get();
        $servicios = Alquiler_recibo::all();
        //dd($alquileres);
        return view('alquiler.alquileres.index',['alquileres' =>$alquileres, 'servicios'=>$servicios]);
    }
    
    public function indexHistorico()
    {
        $alquileres = Alquilere::with(['estadoAlquiler', 'cliente', 'estadoDeposito'])->whereDate('fecha', '<', Carbon::today())->get();
        $servicios = Alquiler_recibo::all();
        //dd($alquileres);
        return view('alquiler.alquileres.history',['alquileres' =>$alquileres, 'servicios'=>$servicios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::with(["tipoProducto", "servicios"])->get();
        $deposito = Deposito::all();
        $descuentos = Descuento::all();
        $metodos=MetodoDePago::all();

        return view("alquiler.alquileres.create", ["clientes"=>$clientes, "productos" => $productos ,"depositos"=>$deposito, "descuentos"=>$descuentos, "metodos"=>$metodos]);
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
            $alquiler = Alquilere::with(["descuento"])->create([ 
                'nombre_id' => $request->nombre_id, 
                'dia_id' => $dia, 
                'descuento' => Descuento::find($request->descuento_id)->cantidad, 
                'estado_id' => 2,//es inpago 
                'monto_final' => 0, // Se actualizará más adelante 
                'monto_adeudado' => 0, // Inicialmente en 0 
                'deposito' => Deposito::find($request->deposito)->monto, 
                'estado_deposito' => ($request->deposito_pago == 1) ? 1 /*Pago*/ : 2 /*Impago*/, 
                'fecha' => $request->fecha 
            ]); 
            if($alquiler){
                // Crear los recibos y calcular el monto final             
                foreach($request->servicios as $servicio) {
                    if(isset($servicio['id']) && isset($servicio['selected'])) { 

                        $servicioPedido = Servicio::with(["producto.tipoProducto"])->findOrFail($servicio['id']);
                
                            if ($servicioPedido->producto && $servicioPedido->producto->tipoProducto) {
                            switch($servicioPedido->producto->tipoProducto->id) {
                                case 1: // QUINCHO
                                    $recibo = Alquiler_recibo::create([
                                        'alquiler_id' => $alquiler->id,
                                        'servicio_nombre' => $servicioPedido->nombre,
                                        'servicio_precio' => $servicioPedido->precio,
                                        'desde' => $servicioPedido->turno->desde,
                                        'hasta' => $servicioPedido->turno->hasta
                                    ]);
                                    break;
                
                                case 2: // PILETA
                                    //temooral hasta configurar las verificaciones
                                    if (!isset($servicio['desde']) || !isset($servicio['hasta'])) {
                                        break;
                                    }

                                    $desde = new \DateTime($servicio['desde']);
                                    $hasta = new \DateTime($servicio['hasta']);
                                    $intervalo = $desde->diff($hasta);

                                    $recibo = Alquiler_recibo::create([
                                        'alquiler_id' => $alquiler->id,
                                        'servicio_nombre' => $servicioPedido->nombre,
                                        'servicio_precio' => $servicioPedido->precio,
                                        'servicio_cantidad' => 1 * $intervalo->h,
                                        'desde' => $servicio['desde'],
                                        'hasta' => $servicio['hasta']
                                    ]);
                                    break;
                
                                case 3: // VAJILLA
                                    //temooral hasta configurar las verificaciones
                                    if (empty($servicio['cantidad'])) {
                                        break;
                                    }
                
                                    $recibo = Alquiler_recibo::create([
                                        'alquiler_id' => $alquiler->id,
                                        'servicio_nombre' => $servicioPedido->nombre,
                                        'servicio_precio' => $servicioPedido->precio,
                                        'servicio_cantidad' => $servicio['cantidad'],
                                    ]);
                                    break;
                            }
                        }
                    }
                }
                
                // CREAR ABONO DE LA SEÑA
                if ($request->seña == 1) {
                    $alquiler->refresh();
                    $datosAbono = [
                        'alquiler_id' => $alquiler->id,
                        'detalle'=> 'Seña',
                        'monto_pagado' => $alquiler->monto_final/2,
                        'metodo_de_pagos_id' => $request->metodo_de_pagos_id
                    ];
                
                    $alquilerAbonoRequest = new AlquilerAbonoRequest();
                    $alquilerAbonoRequest->replace($datosAbono);
 
                    $abonoController = new AlquilerAbonoController();
                    $abonoController->store($alquilerAbonoRequest);
                }

                if ($request->deposito_pago == 1) {
                    $alquiler->refresh();
                    $datosAbono = [
                        'alquiler_id' => $alquiler->id,
                        'detalle'=> 'Depósito',
                        'monto_pagado' => $alquiler->deposito,
                        'metodo_de_pagos_id' => $request->metodo_de_pagos_id,
                        'es_deposito' => true
                    ];
                
                    $alquilerAbonoRequest = new AlquilerAbonoRequest();
                    $alquilerAbonoRequest->replace($datosAbono);
    
                    $abonoController = new AlquilerAbonoController();
                    $abonoController->store($alquilerAbonoRequest);
                }
                
            }
            DB::commit(); 
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }        
        return redirect()->route('alquiler-ver', $alquiler->id);   
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $alquiler = Alquilere::with(["alquilerRecibos", "alquilerAbonos", "cliente", "estadoAlquiler", "estadoDeposito", "dia"])->findOrFail($id);
            $servicios = Alquiler_recibo::all();
            return view("alquiler.alquileres.show", [
                "alquiler" => $alquiler,
                "servicios"=>$servicios
            ]);
        }catch(Exception $e){
            return redirect()->route('404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $alquiler = Alquilere::with(["alquilerRecibos"])->find($id);
           
            $clientes = Cliente::all();
            $deposito = Deposito::all();
            $descuentos = Descuento::all();
            $estados = Estado::all();

            return view("alquiler.alquileres.edit", [
                "alquiler" => $alquiler,
                "clientes" => $clientes,
                "depositos" => $deposito,
                "descuentos" => $descuentos,
                "estados" => $estados
            ]);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    

    

    /**
     * Update the specified resource in storage.
     */
    public function update(AlquilerUpdateRequest $request, $id){   
        try{
            DB::beginTransaction();
            
            $alquiler = Alquilere::with(["alquilerRecibos", "alquilerAbonos"])->findOrFail($id);

            $descuentoNuevo = Descuento::find($request->descuento_id);
            $depositoNuevo = Deposito::find($request->deposito);
        
            $dia = $this->getDayOfWeek($request->fecha);

            $alquiler->update([
                'nombre_id' => $request->nombre_id,
                'dia_id' => $dia,
                'descuento' => $descuentoNuevo->cantidad,
                'deposito' => $depositoNuevo->monto,
                'fecha' => $request->fecha,
            ]);       

            $alquiler->save();
            
            $alquiler->refresh();

            $montoTotal = $alquiler->monto_adeudado + ($alquiler->estadoDeposito->id != 2 ? $alquiler->deposito : 0);
            $alquiler->estado_id = $montoTotal <= 0 ? 1 : 2;
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('alquiler-ver', $id);   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alquilere::destroy($id);
        return redirect()->route("alquileres");
    }

    public function pagarDeposito($id){
        try {
            DB::beginTransaction();

            $alquiler = Alquilere::findOrFail($id);
            $alquiler->estado_deposito = 1;
            $alquiler->save();

            $abonoDeposito = Alquiler_abono::where('alquiler_id', $id)
            ->where('es_deposito', true)
            ->get();

            if($abonoDeposito->isEmpty()){
                $datosAbono = [
                    'alquiler_id' => $alquiler->id,
                    'detalle'=> 'Depósito',
                    'monto_pagado' => $alquiler->deposito,
                    'metodo_de_pagos_id' => 7,
                    'es_deposito' => true
                ];
            
                $alquilerAbonoRequest = new AlquilerAbonoRequest();
                $alquilerAbonoRequest->replace($datosAbono);
    
                $abonoController = new AlquilerAbonoController();
                $abonoController->store($alquilerAbonoRequest);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('alquiler-ver', $id);   
    }

    public function reembolsarDeposito($id){
        try {
            DB::beginTransaction();

            $alquiler = Alquilere::findOrFail($id);
            $alquiler->estado_deposito = 3;
            
            $abonoDeposito = Alquiler_abono::where('alquiler_id', $id)
            ->where('es_deposito', true)
            ->delete();


            $alquiler->save();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('alquiler-ver', $id);   
    }

    public function retenerDeposito($id){
        try {
            DB::beginTransaction();

            $alquiler = Alquilere::findOrFail($id);
            
            $abonoDeposito = Alquiler_abono::where('alquiler_id', $id)
            ->where('es_deposito', true)
            ->get();

            if($abonoDeposito->isEmpty()){
                $datosAbono = [
                    'alquiler_id' => $alquiler->id,
                    'detalle'=> 'Depósito',
                    'monto_pagado' => $alquiler->deposito,
                    'metodo_de_pagos_id' => 7,
                    'es_deposito' => true
                ];
            
                $alquilerAbonoRequest = new AlquilerAbonoRequest();
                $alquilerAbonoRequest->replace(input: $datosAbono);
    
                $abonoController = new AlquilerAbonoController();
                $abonoController->store($alquilerAbonoRequest);
            }
            $alquiler->estado_deposito = 4;
            $alquiler->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('alquiler-ver', $id);   
    }

}
