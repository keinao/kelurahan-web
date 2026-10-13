<?php

namespace Database\Seeders;

use App\Models\Demographic;
use Illuminate\Database\Seeder;

class DemographicSeeder extends Seeder
{
    public function run(): void
    {
        // Data resmi BPS Kota Tomohon (Kecamatan Tomohon Utara Dalam Angka 2026 / Dinas Dukcapil)
        Demographic::updateOrCreate(
            ['year' => 2025],
            [
                'total_population' => 2459,
                'male_population' => 1235,
                'female_population' => 1224,
                'total_families' => 801,
                'total_lingkungan' => 7,
                'notes' => 'Data resmi BPS Kota Tomohon (Kecamatan Tomohon Utara Dalam Angka 2026 / Dinas Dukcapil). Luas wilayah 6,00 km² (kelurahan terluas di Tomohon Utara, 13,16%), kepadatan penduduk 409,83 jiwa/km², rasio jenis kelamin 100,90.',
            ]
        );

        // Data Monografi Semester 1 per 30 Juni 2026
        Demographic::updateOrCreate(
            ['year' => 2026],
            [
                'total_population' => 2456,
                'male_population' => 1228,
                'female_population' => 1228,
                'total_families' => 801,
                'total_lingkungan' => 7,
                'notes' => 'Semester 1 per 30 Juni 2026 (Buku Profil Monografi Kelurahan Kinilow). Jumlah 801 Kepala Keluarga (613 KK Laki-laki dan 188 KK Perempuan). Mayoritas penduduk beragama Kristen dengan mata pencaharian sebagian besar Petani, Penambang Batu, dan Pengrajin Anyaman Bambu.',
            ]
        );
    }
}