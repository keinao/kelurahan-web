<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        if (Facility::query()->exists()) {
            return;
        }

        $facilities = [
            ['Kantor Kelurahan Contoh', 'kantor', true],
            ['Sekolah Contoh', 'sekolah', true],
            ['Fasilitas Kesehatan Contoh', 'kesehatan', true],
            ['Posyandu Contoh', 'posyandu', true],
            ['Tempat Ibadah Contoh', 'ibadah', true],
            ['Lapangan Contoh', 'lapangan', true],
            ['Fasilitas Contoh Nonaktif', 'lainnya', false],
        ];

        foreach ($facilities as [$name, $category, $active]) {
            Facility::create([
                'name' => $name,
                'category' => $category,
                'address' => '[DATA CONTOH] Alamat belum diisi.',
                'description' => '[DATA CONTOH] Deskripsi fasilitas belum diisi.',
                'map_url' => null,
                'is_active' => $active,
            ]);
        }
    }
}