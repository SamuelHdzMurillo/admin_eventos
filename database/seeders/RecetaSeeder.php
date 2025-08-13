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
        $equipos = Equipo::all();

        $recetas = [
            [
                'equipo_id' => $equipos->first()->id,
                'tipo_receta' => 'Plato Principal',
                'descripcion' => 'Enchiladas Verdes con Pollo',
                'ingredientes' => 'Tortillas de maíz, pollo deshebrado, salsa verde, queso fresco, crema, cebolla, cilantro',
                'preparacion' => '1. Cocinar el pollo y deshebrarlo\n2. Preparar la salsa verde\n3. Enchilar las tortillas\n4. Rellenar con pollo y enrollar\n5. Bañar con salsa y gratinar',
                'observaciones' => 'Plato representativo de la cocina mexicana',
                'creado_por' => 'Juan Pérez'
            ],
            [
                'equipo_id' => $equipos->first()->id,
                'tipo_receta' => 'Postre',
                'descripcion' => 'Flan de Caramelo',
                'ingredientes' => 'Huevos, leche condensada, leche evaporada, vainilla, azúcar para caramelo',
                'preparacion' => '1. Preparar el caramelo\n2. Batir los huevos con la leche\n3. Agregar vainilla\n4. Hornear a baño maría\n5. Refrigerar y desmoldar',
                'observaciones' => 'Postre tradicional mexicano',
                'creado_por' => 'Sofía López'
            ]
        ];

        foreach ($recetas as $receta) {
            Receta::create($receta);
        }
    }
} 