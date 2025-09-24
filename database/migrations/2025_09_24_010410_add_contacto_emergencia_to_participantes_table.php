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
        Schema::table('participantes', function (Blueprint $table) {
            $table->string('nombre_contacto_emergencia', 255)->nullable()->after('numero_seguro_social');
            $table->string('telefono_contacto_emergencia', 20)->nullable()->after('nombre_contacto_emergencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->dropColumn(['nombre_contacto_emergencia', 'telefono_contacto_emergencia']);
        });
    }
};
