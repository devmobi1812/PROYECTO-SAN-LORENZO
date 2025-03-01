<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoDePagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodoDePago = [
            ["nombre" => "Efectivo"],
            ["nombre" => "Transferencia"],
            ["nombre" => "Billetera Virtual"],
            ["nombre" => "Tarjeta Credito"],
            ["nombre" => "Tarjeta Debito"],
            ["nombre" => "Credito Personal"],
            ["nombre" => "No especificado"]
        ];
        DB::table("metodo_de_pagos")->insert($metodoDePago);
    }
}
