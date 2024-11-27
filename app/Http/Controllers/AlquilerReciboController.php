<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlquilerReciboStoreRequest;
use App\Http\Requests\AlquilerReciboUpdateRequest;
use App\Models\Alquilere;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Alquiler_recibo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AlquilerReciboController extends Controller
{
    public function index()
    {
        $recibos = Alquiler_recibo::with('alquiler')->get();       
        return view('alquiler.recibos.index', ['recibos'=>$recibos]);
    }
    public function create($id_alquiler)
    {
        try {
            $alquilerAsociado = Alquilere::findOrFail($id_alquiler);
            $productos = Producto::with(["tipoProducto", "servicios"])->get();
            return view("alquiler.recibos.create", [
                "alquiler" => $alquilerAsociado,
                "productos" => $productos
            ]);
        } catch (Exception $e) {
            return redirect()->route("404");
        }
    }

    public function store(AlquilerReciboStoreRequest $request, $alquiler_id)
    {
        try{

            $alquiler = Alquilere::findOrFail($alquiler_id);
            foreach($request->servicios as $servicio) {
                if(isset($servicio['id']) && isset($servicio['selected'])) { 

                    $servicioPedido = Servicio::with(["producto.tipoProducto"])->findOrFail($servicio['id']);
            
                        if ($servicioPedido->producto && $servicioPedido->producto->tipoProducto) {
                        switch($servicioPedido->producto->tipoProducto->id) {
                            case 1:
                                $recibo = Alquiler_recibo::create([
                                    'alquiler_id' => $alquiler->id,
                                    'servicio_nombre' => $servicioPedido->nombre,
                                    'servicio_precio' => $servicioPedido->precio,
                                    'desde' => $servicioPedido->turno->desde,
                                    'hasta' => $servicioPedido->turno->hasta
                                ]);
                                break;
            
                            case 2:
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
            
                            case 3:
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
            $alquiler->save();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("alquiler-ver", $alquiler->id);
    }
    public function edit($id)
    {
        try {
            $recibo = Alquiler_recibo::findOrFail($id);
            $alquilerAsociado = Alquilere::findOrFail($recibo->alquiler_id);
            $productos = Producto::with(["tipoProducto", "servicios"])->get();
            return view("alquiler.recibos.edit", [
                "alquiler" => $alquilerAsociado,
                "recibo" => $recibo,
                "productos" => $productos
            ]);
        } catch (Exception $e) {
            return redirect()->route("404");
        }
    }
    public function update(AlquilerReciboUpdateRequest $request,$id)
    {
        try{
            $recibo = Alquiler_recibo::findOrFail($id);
            $alquiler = Alquilere::findOrFail($recibo->alquiler_id);
            foreach($request->servicios as $servicio) {
                if(isset($servicio['id']) && isset($servicio['selected'])) { 

                    $servicioPedido = Servicio::with(["producto.tipoProducto"])->findOrFail($servicio['id']);
            
                        if ($servicioPedido->producto && $servicioPedido->producto->tipoProducto) {
                        switch($servicioPedido->producto->tipoProducto->id) {
                            case 1:
                                $recibo = Alquiler_recibo::create([
                                    'alquiler_id' => $alquiler->id,
                                    'servicio_nombre' => $servicioPedido->nombre,
                                    'servicio_precio' => $servicioPedido->precio,
                                    'desde' => $servicioPedido->turno->desde,
                                    'hasta' => $servicioPedido->turno->hasta
                                ]);
                                break;
            
                            case 2:
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
            
                            case 3:
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
            $recibo->delete();
            $alquiler->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route("alquiler-ver", $alquiler->id);
    }
    public function destroy($id)
    {   
        $recibo = Alquiler_recibo::findOrFail($id);
        $alquilerAsociado = Alquilere::findOrFail($recibo->alquiler_id);
        Alquiler_recibo::destroy($id);
        return redirect()->route("alquiler-ver", $alquilerAsociado->id);
    }
}
