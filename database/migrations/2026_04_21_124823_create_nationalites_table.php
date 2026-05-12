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
        Schema::create('nationalites', function (Blueprint $table) {
            $table->id();
             $table->foreignId('personne_id')->constrained('personnes')->onDelete('cascade');
            $table->string('nationalite', 255);
            
            $table->string('residence', 255);
            
            $table->string('motif', 255);
            $table->string('nationalite_pere', 255)->nullable();
            $table->string('nationalite_mere', 255)->nullable();
            $table->string('dont_cout');
             $table->string('documents')->nullable();
            $table->string('quittance');
            $table->string('soussignataire', 255);            
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('entite_id')->constrained('entite_administratives');
            $table->string('num_acte')->unique()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nationalites');
    }
};
