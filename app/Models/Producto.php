<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;
use App\Models\TipoProducto;

class Producto extends Model
{
    use HasFactory;

    public function servicios(){
        return $this->hasMany(Servicio::class);
    }

    public function tipoProducto(){
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id');    }

    protected $fillable = ['nombre', 'tipo_producto_id'];
}
