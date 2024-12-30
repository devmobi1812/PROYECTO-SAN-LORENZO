<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dias = [
            ["nombre" => "Domingo"],
            ["nombre" => "Lunes"],
            ["nombre" => "Martes"],
            ["nombre" => "Miércoles"],
            ["nombre" => "Jueves"],
            ["nombre" => "Viernes"],
            ["nombre" => "Sábado"]
        ];
        DB::table("dias")->insert($dias);
    }
}
