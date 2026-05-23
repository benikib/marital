<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personnes', function (Blueprint $table) {
            $table->string('ni')->nullable()->unique()->after('cin');
        });
    }

    public function down(): void
    {
        Schema::table('personnes', function (Blueprint $table) {
            $table->dropColumn('ni');
        });
    }
};