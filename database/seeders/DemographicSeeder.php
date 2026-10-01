<?php

namespace Database\Seeders;

use App\Models\Demographic;
use Illuminate\Database\Seeder;

class DemographicSeeder extends Seeder
{
    public function run(): void
    {
        if (Demographic::query()->exists()) {
            return;
        }

        // Semua angka NULL: data sebenarnya belum tersedia.
        Demographic::create([
            'year' => now()->year,
            'total_population' => null,
            'male_population' => null,
            'female_population' => null,
            'total_families' => null,
            'total_lingkungan' => null,
            'notes' => '[DATA CONTOH] Data kependudukan belum tersedia.',
        ]);
    }
}