<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Turno;
class Servicio extends Model
{
    use HasFactory;

    protected $fillable = ['turno_id', 'producto_id', 'nombre', 'precio'];
    public function turno(){
        return $this->belongsTo(Turno::class);
    }

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
