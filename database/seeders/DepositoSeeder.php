<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Deposito;

class DepositoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deposito::create([
            'nombre' => 'Depósito base',
            'monto' => 15000
        ]);

        Deposito::create([
            'nombre' => 'Sin depósito',
            'monto' => 0
        ]);
    }
}
