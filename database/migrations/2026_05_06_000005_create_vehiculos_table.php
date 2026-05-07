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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id('id_vehiculo');
            $table->string('placa')->unique();
            $table->string('color')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();

            // FK → clientes
            $table->foreignId('cliente_id')
                ->constrained('clientes', 'id_cliente')
                ->onDelete('cascade');

            // FK → tipo_vehiculos
            $table->foreignId('tipo_vehiculo_id')
                ->constrained('tipo_vehiculos', 'id_tipo_vehiculo')
                ->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
