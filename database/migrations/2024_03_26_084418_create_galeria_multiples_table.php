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

        /**cree la tabla pero com esta va a tindre multiples arxius
         * he de fer en la tabla json on despres fare un cast per a que ho puga 
         * traure i guardar be
         * pose tambe la columna del team per a poder crear-ho en els dos panels per si de cas
         * per aixo es nullable
         */
        Schema::create('galeria_multiples', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->json('files')->nullable();
            $table->foreignId('team_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria_multiples');
    }
};
