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
        return $this->belongsTo(Cliente::class);
    }

    public function dia(){
        return $this->belongsTo(Dia::class);
    }

    public function descuento(){
        return $this->belongsTo(Descuento::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function alquilerRecibos(){
        return $this->hasMany(Alquiler_recibo::class);
    }

    public function alquilerAbonos(){
        return $this->hasMany(Alquiler_abono::class);
    }

    protected $fillable = ['monto_final', 'monto_adeudado', 'deposito', 'fecha'];
    
}
