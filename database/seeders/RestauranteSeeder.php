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
        $restaurantes = [
            [
                'nombre' => 'Restaurante El Buen Sabor',
                'estatus' => 'activo',
                'direccion' => 'Av. Principal 123, Centro, Ciudad de México',
                'telefono' => '555-123-4567',
                'correo_electronico' => 'contacto@elbuensabor.com',
                'pagina_web' => 'https://www.elbuensabor.com',
                'codigo_promocional' => 'DESCUENTO20',
                'descripcion_codigo_promocional' => '20% de descuento en el menú del día',
                'imagen' => null
            ],
            [
                'nombre' => 'La Cocina Tradicional',
                'estatus' => 'activo',
                'direccion' => 'Calle Hidalgo 456, Zona Rosa, Ciudad de México',
                'telefono' => '555-234-5678',
                'correo_electronico' => 'info@lacocinatradicional.mx',
                'pagina_web' => 'https://www.lacocinatradicional.mx',
                'codigo_promocional' => 'TRADICION15',
                'descripcion_codigo_promocional' => '15% de descuento en platillos tradicionales',
                'imagen' => null
            ],
            [
                'nombre' => 'Sushi Master',
                'estatus' => 'activo',
                'direccion' => 'Plaza Comercial 789, Polanco, Ciudad de México',
                'telefono' => '555-345-6789',
                'correo_electronico' => 'reservaciones@sushimaster.com',
                'pagina_web' => 'https://www.sushimaster.com',
                'codigo_promocional' => 'SUSHI10',
                'descripcion_codigo_promocional' => '10% de descuento en rolls especiales',
                'imagen' => null
            ],
            [
                'nombre' => 'Pizzeria Italiana',
                'estatus' => 'inactivo',
                'direccion' => 'Av. Insurgentes 321, Roma Norte, Ciudad de México',
                'telefono' => '555-456-7890',
                'correo_electronico' => 'pedidos@pizzeriaitaliana.mx',
                'pagina_web' => null,
                'codigo_promocional' => 'ITALIA25',
                'descripcion_codigo_promocional' => '25% de descuento en pizzas medianas y grandes',
                'imagen' => null
            ],
            [
                'nombre' => 'Café del Centro',
                'estatus' => 'activo',
                'direccion' => 'Plaza Mayor 654, Centro Histórico, Ciudad de México',
                'telefono' => '555-567-8901',
                'correo_electronico' => 'cafe@cafedelcentro.com',
                'pagina_web' => 'https://www.cafedelcentro.com',
                'codigo_promocional' => null,
                'descripcion_codigo_promocional' => null,
                'imagen' => null
            ]
        ];

        foreach ($restaurantes as $restaurante) {
            Restaurante::create($restaurante);
        }
    }
}
