<?php

namespace Database\Seeders;

use App\Models\Potential;
use Illuminate\Database\Seeder;

class PotentialSeeder extends Seeder
{
    public function run(): void
    {
        if (Potential::query()->exists()) {
            return;
        }

        $potentials = [
            ['Potensi Contoh Pertanian', 'potensi-contoh-pertanian', 'pertanian', true, true],
            ['Potensi Contoh UMKM', 'potensi-contoh-umkm', 'umkm', true, true],
            ['Potensi Contoh Kuliner', 'potensi-contoh-kuliner', 'kuliner', true, true],
            ['Potensi Contoh Kerajinan', 'potensi-contoh-kerajinan', 'kerajinan', false, true],
            ['Potensi Contoh Nonaktif', 'potensi-contoh-nonaktif', 'lainnya', true, false],
        ];

        foreach ($potentials as [$name, $slug, $category, $featured, $active]) {
            Potential::create([
                'name' => $name,
                'slug' => $slug,
                'category' => $category,
                'description' => '[DATA CONTOH] Deskripsi potensi belum diisi. Data ini hanya untuk pengujian tampilan.',
                'location' => 'Lingkungan Contoh',
                'is_featured' => $featured,
                'is_active' => $active,
            ]);
        }
    }
}