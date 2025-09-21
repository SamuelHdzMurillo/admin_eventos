<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurante;

class RestauranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo un restaurante de ejemplo
        Restaurante::create([
            'nombre' => 'Restaurante El Buen Sabor',
            'estatus' => 'activo',
            'direccion' => 'Av. Principal 123, Centro, Ciudad de México',
            'telefono' => '555-123-4567',
            'correo_electronico' => 'contacto@elbuensabor.com',
            'pagina_web' => 'https://www.elbuensabor.com',
            'codigo_promocional' => 'DESCUENTO20',
            'descripcion_codigo_promocional' => '20% de descuento en el menú del día',
            'imagen' => null
        ]);
    }
}
