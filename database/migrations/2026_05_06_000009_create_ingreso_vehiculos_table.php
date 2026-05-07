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
        Schema::create('ingreso_vehiculos', function (Blueprint $table) {
            $table->id('id_ingreso');
            $table->date('fecha_ingreso');
            $table->time('hora_ingreso');
            $table->boolean('tiene_membresia')->default(false);

            // FK → vehiculos
            $table->foreignId('vehiculo_id')
                ->constrained('vehiculos', 'id_vehiculo')
                ->onDelete('restrict');

            // FK → espacios
            $table->foreignId('espacio_id')
                ->constrained('espacios', 'id_espacio')
                ->onDelete('restrict');

            // FK → membresias (nullable: puede ingresar sin membresía)
            $table->foreignId('membresia_id')
                ->nullable()
                ->constrained('membresias', 'id_membresia')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingreso_vehiculos');
    }
};
