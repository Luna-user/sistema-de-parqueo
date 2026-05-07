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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contraseña'); // password column
            $table->rememberToken();

            // Datos personales
            $table->string('nombres');
            $table->string('apellidos')->nullable();
            $table->enum('tipo_documento', ['DNI', 'CARNET DE EXTRANJERIA', 'PASAPORTE', 'RUC', 'CI'])->nullable();
            $table->string('nro_documento')->unique()->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro'])->nullable();
            $table->string('direccion')->nullable();
            $table->string('foto')->nullable();

            // Contacto de emergencia
            $table->string('contacto_nombre')->nullable();
            $table->string('contacto_telefono')->nullable();
            $table->string('contacto_parentesco')->nullable();

            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
