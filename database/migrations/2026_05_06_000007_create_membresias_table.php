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
        Schema::create('membresias', function (Blueprint $table) {
            $table->id('id_membresia');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['Activa', 'Vencida', 'Suspendida'])->default('Activa');

            // FK → vehiculos (1 membresía pertenece a 1 solo vehículo)
            $table->foreignId('vehiculo_id')
                ->constrained('vehiculos', 'id_vehiculo')
                ->onDelete('cascade');

            // FK → tipo_membresias
            $table->foreignId('tipo_membresia_id')
                ->constrained('tipo_membresias', 'id_tipo_membresia')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membresias');
    }
};
