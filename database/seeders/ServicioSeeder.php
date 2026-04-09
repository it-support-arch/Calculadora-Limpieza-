<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        // --- SECCIÓN CAMAS ---
        Servicio::create(['nombre' => 'Cama Unipersonal', 'precio' => 1700]);
        Servicio::create(['nombre' => 'Cama Matrimonial', 'precio' => 1900]);
        Servicio::create(['nombre' => 'Cama Queen', 'precio' => 2100]);
        Servicio::create(['nombre' => 'Cama King', 'precio' => 2200]);
        Servicio::create(['nombre' => 'Colchoneta Unipersonal', 'precio' => 850]);
        Servicio::create(['nombre' => 'Colchoneta Matrimonial', 'precio' => 950]);
        Servicio::create(['nombre' => 'Colchoneta Queen', 'precio' => 1300]);
        Servicio::create(['nombre' => 'Colchón de cuna', 'precio' => 950]);
        Servicio::create(['nombre' => 'Moises de bebe', 'precio' => 950]);

        // --- SECCIÓN MUEBLES ---
        Servicio::create(['nombre' => 'Juego de Muebles 3,2,1', 'precio' => 2600]);
        Servicio::create(['nombre' => 'Juego de Muebles 4,3,2', 'precio' => 3200]);
        Servicio::create(['nombre' => 'Sofá Esquinero', 'precio' => 2600]);
        Servicio::create(['nombre' => 'Sofa Cama', 'precio' => 2100]);
        Servicio::create(['nombre' => 'Sofá Unipersonal', 'precio' => 1100]);
        Servicio::create(['nombre' => 'Sofá doble', 'precio' => 1400]);
        Servicio::create(['nombre' => 'Sofá triple', 'precio' => 1600]);

        // --- SECCIÓN VEHÍCULOS (Limpieza Profunda) ---
        Servicio::create(['nombre' => 'Vehículo Sedan Economico', 'precio' => 2800]);
        Servicio::create(['nombre' => 'Vehículo Sedan de lujo (completa)', 'precio' => 3200]);
        Servicio::create(['nombre' => 'Camioneta de 1 cabina', 'precio' => 2800]);
        Servicio::create(['nombre' => 'Camioneta Doble cabina', 'precio' => 3500]);
        Servicio::create(['nombre' => 'Camioneta tipo SUV', 'precio' => 3500]);
        Servicio::create(['nombre' => 'Camioneta de 3 filas (Prado/Rush)', 'precio' => 3800]);

        // --- SECCIÓN SILLAS ---
        Servicio::create(['nombre' => 'Sillas de Espera', 'precio' => 260]);
        Servicio::create(['nombre' => 'Sillas ejecutivas medianas', 'precio' => 400]);
        Servicio::create(['nombre' => 'Sillas ejecutivas Grandes', 'precio' => 600]);

        // --- ALFOMBRAS, VIDRIOS Y PISOS (Por m2) ---
        // Nota: El sistema aplicará C$150 automáticamente si el usuario pone más de 100m2
        Servicio::create(['nombre' => 'Alfombra Fija (m2)', 'precio' => 250]);
        Servicio::create(['nombre' => 'Limpieza de Vidrios (m2)', 'precio' => 250]);
        Servicio::create(['nombre' => 'Limpieza de Pisos (m2)', 'precio' => 250]);

        // --- ALFOMBRAS MÓVILES (Por unidad) ---
        Servicio::create(['nombre' => 'Alfombra móvil pequeña', 'precio' => 500]);
        Servicio::create(['nombre' => 'Alfombra móvil mediana', 'precio' => 700]);
        Servicio::create(['nombre' => 'Alfombra móvil grande', 'precio' => 900]);
    }
}
