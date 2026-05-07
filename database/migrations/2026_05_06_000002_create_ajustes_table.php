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
        Schema::create('ajustes', function (Blueprint $table) {
            $table->id('id_ajuste');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('sucursal');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('logo')->nullable();
            $table->string('logo_auto')->nullable();
            $table->string('divisa', 10)->default('USD'); // moneda / divisa
            $table->decimal('monto', 10, 2)->default(0.00);
            $table->string('correo_electronico')->nullable();
            $table->string('pagina_web')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajustes');
    }
};
