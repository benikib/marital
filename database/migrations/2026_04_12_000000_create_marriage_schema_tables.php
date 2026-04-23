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
        Schema::create('entite_administratives', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type');
            $table->foreignId('parent_id')->nullable()->constrained('entite_administratives')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description');
        });

        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('postnom')->nullable();
           $table->enum('sexe', ['M', 'F']);
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('adresse');
            $table->string('profession');
            $table->string('nationalite');
            $table->enum('etat_civil', [
        'célibataire',
        'marié',
        'divorcé',
        'veuf'
    ])->default('célibataire');
            $table->string('cin')->unique()->nullable();
            $table->string('telephone')->nullable();
            $table->foreignId('localite_id')->nullable()->constrained('entite_administratives')->nullOnDelete();
            $table->foreignId('secteur_id')->nullable()->constrained('entite_administratives')->nullOnDelete();
            $table->foreignId('territoire_id')->nullable()->constrained('entite_administratives')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('entite_administratives')->nullOnDelete();
            $table->foreignId('province_id')->nullable()->constrained('entite_administratives')->nullOnDelete();
            $table->string('pere')->nullable(); 
            $table->string('mere')->nullable();
            $table->string('photo')->nullable();            
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('entite_id')->constrained('entite_administratives');          
            $table->enum('statut_vie', ['en vie', 'décédé'])->default('en vie');
            $table->timestamps();
        });

        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
        });

        Schema::create('regimes_matrimoniaux', function (Blueprint $table) {
            $table->id();
            $table->decimal('dotation_coutumiere', 15, 2);
            $table->foreignId('contrat_id')->constrained('contrats');
        });

        Schema::create('statuts_mariage', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
        });

        Schema::create('mariages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('epoux_id')->constrained('personnes');
            $table->foreignId('epouse_id')->constrained('personnes');
            $table->foreignId('regime_id')->constrained('regimes_matrimoniaux');
            $table->foreignId('statut_id')->constrained('statuts_mariage');
            $table->date('date_mariage');
            $table->string('lieu_mariage');
            $table->string('empreinte_epoux');
            $table->string('empreinte_epouse');
            $table->string('photo_epoux');
            $table->string('photo_epouse');
            $table->string('photo_couple');
            $table->string('etat_civil_epoux');
            $table->string('etat_civil_epouse');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('entite_id')->constrained('entite_administratives');
            $table->timestamps();
        });

        Schema::create('mariage_temoins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mariage_id')->constrained('mariages');
            $table->foreignId('personne_id')->constrained('personnes');
            $table->string('role');
        });

        Schema::create('mariage_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mariage_id')->constrained('mariages');
            $table->foreignId('personne_id')->constrained('personnes');
            $table->string('type_parent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mariage_parents');
        Schema::dropIfExists('mariage_temoins');
        Schema::dropIfExists('mariages');
        Schema::dropIfExists('statuts_mariage');
        Schema::dropIfExists('regimes_matrimoniaux');
        Schema::dropIfExists('contrats');
        Schema::dropIfExists('personnes');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('entite_administratives');
    }
};
