<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alquilere;

class Alquiler_recibo extends Model
{
    use HasFactory;

    public function alquiler(){
        return $this->belongsTo(Alquilere::class, 'alquiler_id');
    }
    
    protected $fillable = ['alquiler_id','servicio_nombre', 'servicio_precio', 'servicio_cantidad', 'desde', 'hasta'];
}
