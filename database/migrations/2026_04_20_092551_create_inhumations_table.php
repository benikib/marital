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
        Schema::create('inhumations', function (Blueprint $table) {
            $table->id();
            $table->string('soussignataire', 255);            
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('entite_id')->constrained('entite_administratives');
            $table->foreignId('personne_id')->constrained('personnes')->onDelete('cascade');
            $table->string('documents')->nullable();
            $table->string('residence_temporaire')->nullable();
            $table->string('lieu_inhumation');
            $table->date('date_inhumation');
            $table->string('num_acte')->unique()->default(null);
            //cimetière
            $table->string('cimetiere');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inhumations');
    }
};
