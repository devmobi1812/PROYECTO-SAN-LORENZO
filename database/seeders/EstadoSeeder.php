<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        $estado = [
            ["nombre" => "Pago"],
            ["nombre" => "Impago"], 
            //para depósitos
            ["nombre" => "Reembolsado"],
            ["nombre" => "Retenido"]

        ];
        DB::table("estados")->insert($estado);
    }
}
