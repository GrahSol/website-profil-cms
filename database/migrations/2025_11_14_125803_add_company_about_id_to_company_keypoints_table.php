<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_keypoints', function (Blueprint $table) {
            // Tambah kolom foreign key saja
            $table->foreignId('company_about_id')
                  ->nullable()
                  ->constrained('company_abouts')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('company_keypoints', function (Blueprint $table) {
            $table->dropForeign(['company_about_id']);
            $table->dropColumn('company_about_id');
        });
    }
};