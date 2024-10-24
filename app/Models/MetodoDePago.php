<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alquiler_abono;
class MetodoDePago extends Model
{
    use HasFactory;

    public function alquilerAbono(){
        return $this->hasMany(Alquiler_abono::class);
    }
}
