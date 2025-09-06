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
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estatus', ['activo', 'inactivo', 'cerrado'])->default('activo');
            $table->text('direccion');
            $table->string('telefono');
            $table->string('correo_electronico');
            $table->string('pagina_web')->nullable();
            $table->string('codigo_promocional')->nullable();
            $table->text('descripcion_codigo_promocional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
