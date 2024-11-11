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
            ["nombre" => "Impago"]
        ];
        DB::table("estados")->insert($estado);
    }
}
