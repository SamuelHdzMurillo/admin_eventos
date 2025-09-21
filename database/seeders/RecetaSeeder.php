<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receta;
use App\Models\Equipo;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipo = Equipo::first();

        // Solo una receta de ejemplo
        Receta::create([
            'equipo_id' => $equipo->id,
            'tipo_receta' => 'Plato Principal',
            'descripcion' => 'Enchiladas Verdes con Pollo',
            'ingredientes' => 'Tortillas de maíz, pollo deshebrado, salsa verde, queso fresco, crema, cebolla, cilantro',
            'preparacion' => '1. Cocinar el pollo y deshebrarlo\n2. Preparar la salsa verde\n3. Enchilar las tortillas\n4. Rellenar con pollo y enrollar\n5. Bañar con salsa y gratinar',
            'observaciones' => 'Plato representativo de la cocina mexicana',
            'creado_por' => 'Juan Pérez'
        ]);
    }
} 