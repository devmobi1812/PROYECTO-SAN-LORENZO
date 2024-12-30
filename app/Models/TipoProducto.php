<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Producto;
class TipoProducto extends Model
{
    use HasFactory;
    protected $table = 'tipo_producto';
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
