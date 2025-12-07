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
        Schema::create('regimes_matrimonauxes', function (Blueprint $table) {
            $table->id();
            $table->string('lieu_mariage_cutinier');
            $table->integer('dotation_cutinier');
            $table->foreignId('contrat_id')->constrained('contrats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regimes_matrimonauxes');
    }
};
