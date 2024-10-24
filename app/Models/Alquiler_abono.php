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
        return $this->belongsTo(Alquilere::class);
    }

    public function metodoDePago(){
        return $this->belongsTo(MetodoDePago::class);
    }
}
