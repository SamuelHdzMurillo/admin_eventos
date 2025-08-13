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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->string('nombre_participante');
            $table->string('rol_participante');
            $table->string('talla_participante');
            $table->string('telefono_participante');
            $table->string('matricula_participante');
            $table->string('correo_participante');
            $table->string('plantel_participante');
            $table->string('plantelcct');
            $table->text('medicamentos')->nullable();
            $table->string('foto_credencial')->nullable();
            $table->string('semestre_participante');
            $table->string('especialidad_participante');
            $table->boolean('seguro_facultativo')->default(false);
            $table->string('tipo_sangre_participante');
            $table->boolean('alergico')->default(false);
            $table->text('alergias')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
}; 