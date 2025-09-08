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
        Schema::create('buzon_asistencia', function (Blueprint $table) {
            $table->id();
            $table->boolean('atendido')->default(false);
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('equipo_id')->nullable()->constrained('equipos')->onDelete('set null');
            $table->enum('estado', ['pendiente', 'en_proceso', 'resuelto', 'cancelado'])->default('pendiente');
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->text('mensaje');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buzon_asistencia');
    }
};
