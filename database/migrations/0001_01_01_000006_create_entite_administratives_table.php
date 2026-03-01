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
            $table->enum('type', [
                'province',
                'ville',
                'territoire',
                'commune',
                'secteur',
                'chefferie'
            ]);
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('entite_administratives')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entite_administratives');
    }
};
