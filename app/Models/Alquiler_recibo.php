<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alquilere;

class Alquiler_recibo extends Model
{
    use HasFactory;

    public function alquiler(){
        return $this->belongsTo(Alquilere::class);
    }
    
    protected $fillable = ['servicio_nombre', 'servicio_precio', 'servicio_cantidad', 'desde', 'hasta'];
}
