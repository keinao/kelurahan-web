<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    public function run(): void
    {
        if (Official::query()->exists()) {
            return;
        }

        $officials = [
            ['Nama Lurah (Contoh)', 'Lurah', true],
            ['Nama Sekretaris (Contoh)', 'Sekretaris Kelurahan', false],
            ['Nama Kepala Seksi Pemerintahan (Contoh)', 'Kepala Seksi Pemerintahan', false],
            ['Nama Kepala Seksi Kesejahteraan (Contoh)', 'Kepala Seksi Kesejahteraan Sosial', false],
            ['Nama Kepala Lingkungan I (Contoh)', 'Kepala Lingkungan I', false],
            ['Nama Kepala Lingkungan II (Contoh)', 'Kepala Lingkungan II', false],
        ];

        foreach ($officials as $index => [$name, $position, $isHead]) {
            Official::create([
                'name' => $name,
                'position' => $position,
                'description' => '[DATA CONTOH] Data perangkat ini hanya untuk pengujian tampilan.',
                'sort_order' => $index + 1,
                'is_head' => $isHead,
                'is_active' => true,
            ]);
        }
    }
}