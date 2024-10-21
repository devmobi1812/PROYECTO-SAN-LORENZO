<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alquilere;

class Dia extends Model
{
    use HasFactory;

    public function alquileres(){
        return $this->hasMany(Alquilere::class);
    }
}
