<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turno>
 */
class TurnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $horaInicio = fake()->time();
        $horaFin = date("H:i:s", strtotime($horaInicio. "+ 4 hour"));
        return [
            
            "nombre"=> fake()->word(),
            "desde" => $horaInicio,
            "hasta" => $horaFin
            
        ];
        
    }
}
