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
        //recuerda definir si algunos att pueden llegar a ser nulos nullable
        //tambien va el metodo de borrado, en este caso es cascade pero podria ser set to null 
        //o algo por el estilo
        /**Impotante tener en cuenta el diseño de la DB */
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->text('notes')->nullable();
            
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->unsignedInteger('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
