<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Turno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            
            'turno_id' => Turno::factory(),
            'producto_id' => Producto::factory(),
            'nombre' => fake()->word(),
            'precio' => fake()->numberBetween(2000, 180000)
            
        ];
        
    }
}
