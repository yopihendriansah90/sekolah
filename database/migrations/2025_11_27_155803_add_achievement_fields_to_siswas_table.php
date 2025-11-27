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
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('achievement_title')->nullable()->after('phone');
            $table->text('achievement_description')->nullable()->after('achievement_title');
            $table->string('competition_name')->nullable()->after('achievement_description');
            $table->enum('achievement_level', ['sekolah', 'kecamatan', 'kabupaten', 'provinsi', 'nasional', 'internasional'])->nullable()->after('competition_name');
            $table->year('achievement_year')->nullable()->after('achievement_level');
            $table->enum('achievement_category', ['akademik', 'olahraga', 'seni', 'teknologi', 'bahasa', 'sains', 'sosial', 'lainnya'])->nullable()->after('achievement_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn([
                'achievement_title',
                'achievement_description',
                'competition_name',
                'achievement_level',
                'achievement_year',
                'achievement_category',
            ]);
        });
    }
};
