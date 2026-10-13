<?php

namespace Database\Seeders;

use App\Models\VillageProfile;
use Illuminate\Database\Seeder;

class VillageProfileSeeder extends Seeder
{
    public function run(): void
    {
        VillageProfile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Kelurahan Kinilow',
                'short_description' => 'Website resmi Kelurahan Kinilow, Kecamatan Tomohon Utara, Kota Tomohon, Sulawesi Utara.',
                'description' => 'Kelurahan Kinilow adalah salah satu kelurahan di wilayah administratif Kecamatan Tomohon Utara, Kota Tomohon, Provinsi Sulawesi Utara. Terletak di kawasan dataran tinggi yang asri di antara Gunung Lokon dan Gunung Mahawu, Kinilow merupakan kelurahan dengan wilayah terluas di Kecamatan Tomohon Utara (6,00 km²) serta memiliki potensi unggulan di bidang pariwisata alam dan sentra kerajinan anyaman bambu.',
                'welcome_message' => 'Selamat datang di Website Resmi Kelurahan Kinilow. Portal ini menyajikan informasi keterbukaan publik, profil wilayah, data kependudukan, serta pelayanan pemerintahan bagi seluruh masyarakat.',
                'history' => 'Kelurahan Kinilow merupakan salah satu kelurahan di wilayah Kecamatan Tomohon Utara, Kota Tomohon. Dahulunya Kinilow merupakan satu kesatuan Desa Kinilow yang kemudian berkembang dan dimekarkan menjadi Kelurahan Kinilow dan Kelurahan Kinilow Satu seiring dengan terbentuknya Kota Tomohon sebagai kota otonom.',
                'vision' => 'Tomohon Maju, Berdaya Saing, dan Sejahtera Menuju Indonesia Emas 2045',
                'mission' => "1. Menjaga dan melestarikan Tomohon sebagai kota relijius dan berbudaya.\n2. Mewujudkan ketahanan pangan dan pembangunan yang berwawasan lingkungan.\n3. Menjadikan Tomohon kota wisata dunia.\n4. Meningkatkan kesejahteraan masyarakat.\n5. Menjadikan Pemerintah Kota Tomohon yang berintegritas, adaptif, dan responsif.",
                'geography' => 'Kelurahan Kinilow berada di kawasan dataran tinggi pada ketinggian rata-rata ± 700 meter di atas permukaan laut (mdpl), diapit oleh panorama Gunung Lokon dan Gunung Mahawu dengan suhu udara yang sejuk. Berdasarkan publikasi resmi BPS (Kecamatan Tomohon Utara Dalam Angka), Kelurahan Kinilow memiliki luas wilayah daratan 6,00 km² (13,16% dari total luas kecamatan) yang menjadikannya kelurahan terluas di Kecamatan Tomohon Utara. Jarak dari kelurahan ke ibukota kecamatan adalah 3,00 km dan ke pusat Kota Tomohon adalah 3,00 km.',
                'area_km2' => 6.00,
                'boundary_north' => 'Kelurahan Tinoor Satu dan Desa Kali, Kabupaten Minahasa',
                'boundary_south' => 'Kelurahan Kinilow Satu',
                'boundary_east' => 'Hutan Lindung dan Kabupaten Minahasa',
                'boundary_west' => 'Hutan Lindung',
                'address' => 'Jl. Raya Tomohon - Manado, Kelurahan Kinilow, Lingkungan II',
                'district' => 'Kecamatan Tomohon Utara',
                'regency' => 'Kota Tomohon',
                'province' => 'Sulawesi Utara',
                'postal_code' => '95439',
                'office_hours' => 'Senin – Jumat, 08.00 – 16.00 WITA',
            ]
        );
    }
}