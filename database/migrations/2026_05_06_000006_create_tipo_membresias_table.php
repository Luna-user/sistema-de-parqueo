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
        Schema::create('tipo_membresias', function (Blueprint $table) {
            $table->id('id_tipo_membresia');
            $table->string('nombre')->nullable(); // Ej: Mensual, Semanal, Diaria
            $table->decimal('costo', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_membresias');
    }
};
