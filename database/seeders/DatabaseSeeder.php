<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Hanya data contoh untuk development. Akun admin dibuat
     * lewat: php artisan make:filament-user
     */
    public function run(): void
    {
        $this->call([
            VillageProfileSeeder::class,
            OfficialSeeder::class,
            DemographicSeeder::class,
            NewsSeeder::class,
            PotentialSeeder::class,
            FacilitySeeder::class,
        ]);
    }
}