<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RutaTransporte;

class RutaTransporteSeeder extends Seeder
{
    public function run(): void
    {
        $rutas = [
            ['zona' => 'Managua', 'nombre_ruta' => 'Carretera a masaya (Managua)', 'costo' => 0],
            ['zona' => 'Managua', 'nombre_ruta' => ' KM 13 en adelante', 'costo' => 185],
            ['zona' => 'Managua', 'nombre_ruta' => ' Ticuantepe', 'costo' => 370],
            ['zona' => 'Managua', 'nombre_ruta' => ' Veracruz', 'costo' => 0],
            ['zona' => 'Managua', 'nombre_ruta' => 'Nindiri', 'costo' => 555],
            ['zona' => 'Managua', 'nombre_ruta' => 'Masaya', 'costo' => 740],
             ['zona' => 'Managua', 'nombre_ruta' => 'Catarina', 'costo' => 925],
             ['zona' => 'Managua', 'nombre_ruta' => 'Niquinohomo', 'costo' => 925],
             ['zona' => 'Managua', 'nombre_ruta' => 'Diriamba', 'costo' => 740],
             ['zona' => 'Managua', 'nombre_ruta' => 'Diriomo', 'costo' => 925],
             ['zona' => 'Managua', 'nombre_ruta' => 'Granada', 'costo' => 925],
             ['zona' => 'Managua', 'nombre_ruta' => 'Apoyo', 'costo' => 925],
             ['zona' => 'Managua', 'nombre_ruta' => 'Rivas', 'costo' => 1480],
             ['zona' => 'Managua', 'nombre_ruta' => 'San Juan Del Sur', 'costo' => 1850],
             ['zona' => 'Managua', 'nombre_ruta' => 'Tola', 'costo' => 2220],
             ['zona' => 'Managua', 'nombre_ruta' => 'Peñas Blancas', 'costo' => 2220],
             ['zona' => 'Managua', 'nombre_ruta' => 'Nandaime', 'costo' => 1295],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Carretera Norte (Managua)', 'costo' => 0],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Tipitapa', 'costo' => 555],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Boaco', 'costo' => 1480],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'San benito', 'costo' => 740],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Juigalpa - Chontales', 'costo' => 1850],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Santo Tomas - Chontales', 'costo' => 2590],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Ciudad Dario', 'costo' => 1110],
             ['zona' => 'Carretera Norte', 'nombre_ruta' => 'Camoapa', 'costo' => 1850],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Carretera Sur hasta el km 10', 'costo' => 0],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Managua. Monte Tabor o INCAE', 'costo' => 370],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'El crucero', 'costo' => 555],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Carazo', 'costo' => 925],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Santa Teresa', 'costo' => 925],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'La conquista', 'costo' => 925],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Jinotepe', 'costo' => 925],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Masatepe', 'costo' => 740],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Diriamba', 'costo' => 740],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'La boquita', 'costo' => 1480],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Los cedros', 'costo' => 370],
             ['zona' => 'Carretera Sur', 'nombre_ruta' => 'Puerto Sandino', 'costo' => 1295],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Carretera N. Leon (Managua)', 'costo' => 0],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Ciudad Sandino', 'costo' => 0],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Los Brasiles', 'costo' => 185],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Ciudad el Doral', 'costo' => 185],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Mateare', 'costo' => 370],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Vistas de momotombo', 'costo' => 370],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'Nagarote', 'costo' => 925],
             ['zona' => 'Carretera Nueva Leon', 'nombre_ruta' => 'La Paz Centro', 'costo' => 1110],
             ['zona' => 'Occidente/Chinandega/Carretera Leon', 'nombre_ruta' => 'Chichigalpa', 'costo' => 370],
             ['zona' => 'Occidente/Chinandega/Carretera Leon', 'nombre_ruta' => 'Posoltega', 'costo' => 370],
             ['zona' => 'Occidente/Chinandega/Carretera Leon', 'nombre_ruta' => 'Telica', 'costo' => 740],
             ['zona' => 'Occidente/Chinandega/Carretera Leon', 'nombre_ruta' => 'Leon ', 'costo' => 740],
             ['zona' => 'Occidente/Chinandega/Carretera Leon', 'nombre_ruta' => 'Poneloya', 'costo' => 925],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'Rancheria', 'costo' => 555],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'La villa 15 de julio', 'costo' => 740],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'Villa Nueva', 'costo' => 1110],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'Somotillo', 'costo' => 1295],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'El Sauce', 'costo' => 1480],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'Sto. Tomas del Norte', 'costo' => 1480],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'Mina el Limon', 'costo' => 1480],
             ['zona' => 'Occidente/Chinandega/Carretera Somotillo', 'nombre_ruta' => 'Guasaule', 'costo' => 1480],
             ['zona' => 'Carretera el Viejo', 'nombre_ruta' => 'El viejo', 'costo' => 185],                 ['zona' => 'Carretera el Viejo', 'nombre_ruta' => 'Tonala', 'costo' => 370],
             ['zona' => 'Carretera el Viejo', 'nombre_ruta' => 'Jiquilillo', 'costo' => 555],
             ['zona' => 'Carretera el Viejo', 'nombre_ruta' => 'Cosiguina', 'costo' => 925],
             ['zona' => 'Carretera Corinto', 'nombre_ruta' => 'El realejo', 'costo' => 370],
             ['zona' => 'Carretera Corinto', 'nombre_ruta' => 'Paso Caballo', 'costo' => 370],
             ['zona' => 'Carretera Corinto', 'nombre_ruta' => 'Corinto', 'costo' => 370],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Esteli', 'costo' => 1850],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Condega', 'costo' => 2220],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Pueblo Nuevo', 'costo' => 2590],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Palacaguina', 'costo' => 2590],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Yanli', 'costo' => 2590],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Somoto', 'costo' => 3700],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Ocotal', 'costo' => 3700],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Jalapa', 'costo' => 3700],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'San Rafael del Norte', 'costo' => 2590],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'Quilali', 'costo' => 2590],
             ['zona' => 'Carretera Panamericana Norte', 'nombre_ruta' => 'La concordia', 'costo' => 2590],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'La cruz', 'costo' => 1480],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'La trinidad', 'costo' => 1295],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'San Isidro', 'costo' => 1295],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'Sebaco', 'costo' => 1295],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'Matagalpa', 'costo' => 1480],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'Jinotega', 'costo' => 1850],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'Dario', 'costo' => 1110],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'Muy muy', 'costo' => 1850],
             ['zona' => 'Carretera Panamericana Sur', 'nombre_ruta' => 'Matiguas', 'costo' => 1850],

            // Agrega aquí todas tus zonas y rutas del Excel
        ];

        foreach ($rutas as $r) {
            RutaTransporte::updateOrCreate(
                ['zona' => $r['zona'], 'nombre_ruta' => $r['nombre_ruta']],
                $r
            );
        }
    }
}
