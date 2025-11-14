<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_keypoints', function (Blueprint $table) {
            // Set default values untuk kolom yang required
            $table->string('achievement')->default('')->change();
            $table->string('thumbnail')->default('')->change();
            $table->string('type')->default('')->change();
        });
    }

    public function down(): void
    {
        Schema::table('company_keypoints', function (Blueprint $table) {
            $table->string('achievement')->default(null)->change();
            $table->string('thumbnail')->default(null)->change();
            $table->string('type')->default(null)->change();
        });
    }
};