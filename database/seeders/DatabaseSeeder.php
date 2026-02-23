<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos 10 proyectos
        Proyecto::factory(20)->create()->each(function ($proyecto) {
            Tarea::factory(rand(3, 8))->create([
                'proyecto_id' => $proyecto->id,
            ]);
        });
    }
}
