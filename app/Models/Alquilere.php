<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Dia;
use App\Models\Descuento;
use App\Models\Estado;
use App\Models\Alquiler_recibo;
use App\Models\Alquiler_abono;


class Alquilere extends Model
{
    use HasFactory;

    public function cliente(){
        return $this->belongsTo(Cliente::class, "nombre_id");
    }

    public function dia(){
        return $this->belongsTo(Dia::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class, "estado_id");
    }

    public function alquilerRecibos(){
        return $this->hasMany(Alquiler_recibo::class, "alquiler_id");
    }

    public function alquilerAbonos(){
        return $this->hasMany(Alquiler_abono::class, "alquiler_id");
    }

    protected $fillable = ['nombre_id', 'dia_id', 'descuento', 'estado_id', 'monto_final', 'monto_adeudado', 'deposito', 'fecha'];
    
    protected static function boot() { 
        parent::boot(); 
        static::deleting(function ($alquiler) { 
            $alquiler->alquilerRecibos()->delete(); 
            $alquiler->alquilerAbonos()->delete(); 
        }); 
    }

}
