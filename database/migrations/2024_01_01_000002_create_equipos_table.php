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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_equipo');
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->string('entidad_federativa');
            $table->enum('estatus_del_equipo', ['activo', 'pendiente', 'eliminado'])->default('pendiente');
            $table->string('nombre_anfitrion');
            $table->string('telefono_anfitrion');
            $table->string('correo_anfitrion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
}; 