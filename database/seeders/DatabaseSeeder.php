<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Descuento;
use App\Models\Servicio;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(DepositoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(DiaSeeder::class);
        $this->call(MetodoDePagoSeeder::class);
        $this->call(TipoProductoSeeder::class);

        /*
        Descuento::factory(11)->create();
        Cliente::factory(100)->create();
        Servicio::factory(20)->create();
        */
    }
}
