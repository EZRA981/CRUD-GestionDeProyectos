<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyecto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(4),
            'descripcion' => $this->faker->text(100),
            'estado' => $this->faker->randomElement(['pendiente', 'en_proceso', 'finalizado']),
            'prioridad' => $this->faker->randomElement(['Baja', 'Media', 'Alta']),
            'fecha_limite' => $this->faker->dateTimeBetween('now', '+20 days'),
            'proyecto_id' => Proyecto::factory(), 
        ];
    }
}
