<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alquilere;
use App\Models\MetodoDePago;

class Alquiler_abono extends Model
{
    use HasFactory;

    public function alquiler(){
        return $this->belongsTo(Alquilere::class, 'alquiler_id');
    }

    public function metodoDePago(){
        return $this->belongsTo(MetodoDePago::class, 'metodo_de_pagos_id');
    }
    protected $fillable = ['alquiler_id','monto_pagado', 'metodo_de_pagos_id', 'detalle', 'es_deposito'];
}
