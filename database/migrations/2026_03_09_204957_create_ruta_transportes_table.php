<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ruta_transportes', function (Blueprint $table) {
            $table->id();
            // La Zona (Ej: Carretera a Masaya, Carretera Norte, Estelí)
            $table->string('zona');

            // El Destino específico (Ej: Ticuantepe, Ciudad Sandino, Somoto)
            $table->string('nombre_ruta');

            // El Costo en Córdobas (Ej: 185, 925, 3700)
            $table->decimal('costo', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruta_transportes');
    }
};
