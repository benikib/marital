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
        Schema::create('composition_familiale_personnes', function (Blueprint $table) {
            $table->id();
             $table->foreignId('composition_familiale_id')
                ->constrained('composition_familiales')
                ->onDelete('cascade');

            $table->foreignId('personne_id')
                ->constrained('personnes')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composition_familiale_personnes');
    }
};
