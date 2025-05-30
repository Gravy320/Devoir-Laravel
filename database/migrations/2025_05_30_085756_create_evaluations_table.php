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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enseignant_id'); //Clé étrangère des enseignants
            $table->string('Titre', 45);
            $table->date('Date')->nullable();
            $table->string('Matière', 45)->nullable(); //La Matière est la matière de l'évaluation
            $table->string('Type', 45)->nullable();  //Le Type renvoie à si c'est un "Devoir" ou un "Examen"
            $table->timestamps();
            $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
