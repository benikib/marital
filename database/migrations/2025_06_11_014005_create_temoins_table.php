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
        Schema::create('temoins', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('postnom');
            $table->string('profession');
            $table->string('adresse');
            $table->string('province');
            $table->string('nationalite');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('etat_civil');
            $table->foreignId('epoux_id')->nullable()->constrained('epouxes')->onDelete('cascade');
            $table->foreignId('epouse_id')->nullable()->constrained('epouses')->onDelete('cascade');
            $table->string('photo')->nullable(); // Photo du témoin
            $table->string('photo_cni')->nullable(); // Photo de la CNI
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temoins');
    }
};
