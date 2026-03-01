<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('regimes_matrimonauxes')) {
            // If old columns exist, rename them
            if (Schema::hasColumn('regimes_matrimonauxes', 'lieu_mariage_cutinier')) {
                Schema::table('regimes_matrimonauxes', function (Blueprint $table) {
                    try {
                        $table->renameColumn('lieu_mariage_cutinier', 'lieu_mariage_coutumier');
                    } catch (\Throwable $e) {
                        // Fallback: raw SQL
                        $driver = Schema::getConnection()->getDriverName();
                        if ($driver === 'mysql') {
                            DB::statement('ALTER TABLE `regimes_matrimonauxes` CHANGE `lieu_mariage_cutinier` `lieu_mariage_coutumier` VARCHAR(255)');
                        }
                    }
                });
            }

            if (Schema::hasColumn('regimes_matrimonauxes', 'dotation_cutinier')) {
                Schema::table('regimes_matrimonauxes', function (Blueprint $table) {
                    try {
                        $table->renameColumn('dotation_cutinier', 'dotation_coutumier');
                    } catch (\Throwable $e) {
                        $driver = Schema::getConnection()->getDriverName();
                        if ($driver === 'mysql') {
                            DB::statement('ALTER TABLE `regimes_matrimonauxes` CHANGE `dotation_cutinier` `dotation_coutumier` INT');
                        }
                    }
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('regimes_matrimonauxes')) {
            if (Schema::hasColumn('regimes_matrimonauxes', 'lieu_mariage_coutumier')) {
                Schema::table('regimes_matrimonauxes', function (Blueprint $table) {
                    try {
                        $table->renameColumn('lieu_mariage_coutumier', 'lieu_mariage_cutinier');
                    } catch (\Throwable $e) {
                        $driver = Schema::getConnection()->getDriverName();
                        if ($driver === 'mysql') {
                            DB::statement('ALTER TABLE `regimes_matrimonauxes` CHANGE `lieu_mariage_coutumier` `lieu_mariage_cutinier` VARCHAR(255)');
                        }
                    }
                });
            }

            if (Schema::hasColumn('regimes_matrimonauxes', 'dotation_coutumier')) {
                Schema::table('regimes_matrimonauxes', function (Blueprint $table) {
                    try {
                        $table->renameColumn('dotation_coutumier', 'dotation_cutinier');
                    } catch (\Throwable $e) {
                        $driver = Schema::getConnection()->getDriverName();
                        if ($driver === 'mysql') {
                            DB::statement('ALTER TABLE `regimes_matrimonauxes` CHANGE `dotation_coutumier` `dotation_cutinier` INT');
                        }
                    }
                });
            }
        }
    }
};
