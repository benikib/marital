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
        Schema::create('divorces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('entite_id')->constrained('entite_administratives');
            $table->foreignId('mariage_id')->constrained('mariages')->onDelete('cascade');
            $table->date('date_divorce');
            $table->string('divorce_rendu', 255)->default('Tribunal de paix'); 
            $table->date('date_transcription')->nullable();
            $table->date('date_jugement')->nullable();
            $table->string('numero_jugement', 255)->nullable();
            $table->string('mentions_complementaire')->nullable();
            $table->string('documents')->nullable();
            $table->string('soussignataire', 255);
            $table->string('num_acte')->unique()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divorces');
    }
};
