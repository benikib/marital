<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mariages', function (Blueprint $table) {
            $table->id();
            $table->string('lieu_mariage');
            $table->date('date_mariage');
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('regime_matrimonial_id')->constrained('regimes_matrimonauxes');
            $table->foreignId('ayant_droit_coutinier_id')->constrained('ayant_droit_coutiniers');
            $table->foreignId('epouse_id')->constrained('epouses');
            $table->foreignId('epoux_id')->constrained('epouxes');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('commune_id')->constrained('communes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mariages');
    }
};
