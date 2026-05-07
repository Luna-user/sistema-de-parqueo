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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');

            // FK → metodo_pagos
            $table->foreignId('metodo_id')
                ->constrained('metodo_pagos', 'id_metodo')
                ->onDelete('restrict');

            // FK → membresias (nullable: pago por hora no tiene membresía)
            $table->foreignId('membresia_id')
                ->nullable()
                ->constrained('membresias', 'id_membresia')
                ->onDelete('set null');

            // FK → ingreso_vehiculos (nullable: el pago de membresía no tiene ingreso directo)
            $table->foreignId('ingreso_id')
                ->nullable()
                ->constrained('ingreso_vehiculos', 'id_ingreso')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
