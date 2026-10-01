<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demographics', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year')->unique();
            $table->unsignedInteger('total_population')->nullable();
            $table->unsignedInteger('male_population')->nullable();
            $table->unsignedInteger('female_population')->nullable();
            $table->unsignedInteger('total_families')->nullable();
            $table->unsignedSmallInteger('total_lingkungan')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demographics');
    }
};