<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('mariages') && ! Schema::hasColumn('mariages', 'entite_id')) {
            Schema::table('mariages', function (Blueprint $table) {
                $table->foreignId('entite_id')->nullable()->after('commune_id')->constrained('entite_administratives')->nullOnDelete();
            });

            // Backfill entite_id by matching commune name to entite_administratives of type 'commune'
            // This assumes communes.nom matches entite_administratives.nom for communes
            DB::statement("UPDATE mariages m
                JOIN communes c ON m.commune_id = c.id
                JOIN entite_administratives e ON e.nom = c.nom AND e.type = 'commune'
                SET m.entite_id = e.id");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('mariages') && Schema::hasColumn('mariages', 'entite_id')) {
            Schema::table('mariages', function (Blueprint $table) {
                try {
                    $table->dropForeign(['entite_id']);
                } catch (\Throwable $e) {
                    // ignore
                }
                $table->dropColumn('entite_id');
            });
        }
    }
};
