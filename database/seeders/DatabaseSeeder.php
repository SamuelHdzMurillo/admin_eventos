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
            EventoSeeder::class,
            EquipoSeeder::class,
            ParticipanteSeeder::class,
            AcompananteSeeder::class,
            RecetaSeeder::class,
            CedulaRegistroSeeder::class,
        ]);
    }
}
