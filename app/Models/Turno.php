<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','desde','hasta'];
    
    public function servicios(){
        return $this->hasMany(Servicio::class);
    }

    
}
