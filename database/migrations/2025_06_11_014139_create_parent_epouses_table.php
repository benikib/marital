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
        Schema::create('parent_epouses', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('postnom');
            $table->string('profession');
            $table->string('adresse');
            $table->boolean('enVie');
            $table->string('province');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('nationalite');
            $table->string('type')->default('pere');
            $table->foreignId('epouse_id')->constrained('epouses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_epouses');
    }
};
