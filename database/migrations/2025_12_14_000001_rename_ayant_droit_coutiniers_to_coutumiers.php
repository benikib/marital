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
        // Rename table if exists
        if (Schema::hasTable('ayant_droit_coutiniers')) {
            Schema::rename('ayant_droit_coutiniers', 'ayant_droit_coutumiers');
        }

        // Update mariages foreign key and column
        if (Schema::hasTable('mariages') && Schema::hasColumn('mariages', 'ayant_droit_coutinier_id')) {
            Schema::table('mariages', function (Blueprint $table) {
                // Drop foreign if exists (wrapped in try/catch to ignore if it doesn't)
                try {
                    $table->dropForeign(['ayant_droit_coutinier_id']);
                } catch (\Throwable $e) {
                    // ignore if constraint doesn't exist
                }
            });

            // Rename column using raw SQL to avoid requiring doctrine/dbal
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE `mariages` CHANGE `ayant_droit_coutinier_id` `ayant_droit_coutumier_id` BIGINT UNSIGNED NULL');
            } else {
                // Fallback: attempt Laravel renameColumn (requires doctrine/dbal)
                Schema::table('mariages', function (Blueprint $table) {
                    $table->renameColumn('ayant_droit_coutinier_id', 'ayant_droit_coutumier_id');
                });
            }

            // Add new foreign constraint
            Schema::table('mariages', function (Blueprint $table) {
                $table->foreign('ayant_droit_coutumier_id')->references('id')->on('ayant_droit_coutumiers')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert mariages column name and foreign key
        if (Schema::hasTable('mariages') && Schema::hasColumn('mariages', 'ayant_droit_coutumier_id')) {
            Schema::table('mariages', function (Blueprint $table) {
                try {
                    $table->dropForeign(['ayant_droit_coutumier_id']);
                } catch (\Throwable $e) {
                    // ignore
                }
            });

            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE `mariages` CHANGE `ayant_droit_coutumier_id` `ayant_droit_coutinier_id` BIGINT UNSIGNED NULL');
            } else {
                Schema::table('mariages', function (Blueprint $table) {
                    $table->renameColumn('ayant_droit_coutumier_id', 'ayant_droit_coutinier_id');
                });
            }

            Schema::table('mariages', function (Blueprint $table) {
                $table->foreign('ayant_droit_coutinier_id')->references('id')->on('ayant_droit_coutiniers')->nullOnDelete();
            });
        }

        // Rename table back
        if (Schema::hasTable('ayant_droit_coutumiers')) {
            Schema::rename('ayant_droit_coutumiers', 'ayant_droit_coutiniers');
        }
    }
};
