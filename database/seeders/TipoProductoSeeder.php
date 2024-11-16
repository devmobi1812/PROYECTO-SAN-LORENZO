<?php

namespace Database\Seeders;

use App\Models\TipoProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            TipoProducto::create([
                'nombre' => 'Inmueble horario fijo'
            ]);

            TipoProducto::create([
                'nombre' => 'Inmueble horario flexible'
            ]);

            TipoProducto::create([
                'nombre' => 'No inmueble'
            ]);
        }
    }
}