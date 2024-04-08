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
        Schema::table('galeries', function (Blueprint $table) {
            //añado la columna del equipo para la galeria
            /**intento de otorgar permisos sobre la foto al estar en el panel que no hace
             * falta que sea admin
             * como ya tengo dos creadas necesito que sea nullable
             * para evitar una migration fresh
             */
            $table->foreignId('team_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeries', function (Blueprint $table) {
            //si se borra se borra
            $table->dropColumn('team_id');
        });
    }
};
