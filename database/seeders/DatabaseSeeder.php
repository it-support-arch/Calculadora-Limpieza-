<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Esto le dice a Laravel que ejecute ambos archivos
        $this->call([
            ServicioSeeder::class,
            RutaTransporteSeeder::class,
        ]);
    }
}
