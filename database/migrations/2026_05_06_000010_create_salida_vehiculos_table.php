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
        Schema::create('salida_vehiculos', function (Blueprint $table) {
            $table->id('id_salida');
            $table->date('fecha_salida');
            $table->time('hora_salida');

            // FK → ingreso_vehiculos (1 salida corresponde a 1 ingreso)
            $table->foreignId('ingreso_id')
                ->unique() // cada ingreso solo puede tener 1 salida
                ->constrained('ingreso_vehiculos', 'id_ingreso')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salida_vehiculos');
    }
};
