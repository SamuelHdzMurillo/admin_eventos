<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Ejecutar seeders en orden de dependencias
        $this->call([
            EventoSeeder::class,        // Primero el evento
            UserSeeder::class,          // Luego los usuarios (admin, pruebas, estados)
            EquipoSeeder::class,        // Después los equipos
            ParticipanteSeeder::class,  // Participantes del primer equipo
            AcompananteSeeder::class,   // Acompañantes del primer equipo
            RecetaSeeder::class,        // Recetas del primer equipo
            CedulaRegistroSeeder::class, // Cédula de registro del primer equipo
            ComiteSeeder::class,        // Comité del evento
            HospedajeSeeder::class,     // Hospedajes
            RestauranteSeeder::class,   // Restaurantes
            LugarInteresSeeder::class,  // Lugares de interés
            BuzonAsistenciaSeeder::class, // Buzón de asistencia (al final)
        ]);
    }
}
