<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('short_description', 500)->nullable();
            $table->text('description')->nullable();
            $table->text('welcome_message')->nullable();
            $table->text('history')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('geography')->nullable();
            $table->decimal('area_km2', 8, 2)->nullable();
            $table->string('boundary_north', 255)->nullable();
            $table->string('boundary_south', 255)->nullable();
            $table->string('boundary_east', 255)->nullable();
            $table->string('boundary_west', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('district', 100)->nullable();
            $table->string('regency', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('office_hours')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->string('map_url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_profiles');
    }
};