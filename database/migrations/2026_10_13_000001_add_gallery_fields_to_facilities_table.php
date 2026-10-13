<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table): void {
            $table->string('slug', 180)->nullable()->unique();
            $table->json('photos')->nullable();
            $table->string('subtitle', 180)->nullable();
            $table->string('category', 50)->nullable()->default(null)->change();
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'photos', 'subtitle']);
            $table->string('category', 50)->default('lainnya')->nullable(false)->change();
        });
    }
};