<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alquilere;

class Estado extends Model
{
    use HasFactory;

    public function alquilere(){
        return $this->hasMany(Alquilere::class);
    }
}
