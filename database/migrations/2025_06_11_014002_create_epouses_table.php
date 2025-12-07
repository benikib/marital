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
        Schema::create('epouses', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('postnom');
            $table->string('profession');
            $table->string('adresse');
            $table->string('district');
            $table->string('province');
            $table->string('nationalite');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('secteur');
            $table->string('territoire');
            $table->string('url_photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epouses');
    }
};
