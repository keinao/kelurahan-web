<?php

namespace Database\Seeders;

use App\Models\VillageProfile;
use Illuminate\Database\Seeder;

class VillageProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya ada satu profil. Jangan menimpa data yang sudah diisi admin.
        if (VillageProfile::query()->exists()) {
            return;
        }

        VillageProfile::create([
            'name' => 'Kelurahan Contoh',
            'short_description' => '[DATA CONTOH] Deskripsi singkat kelurahan akan tampil di bagian atas Beranda.',
            'description' => '[DATA CONTOH] Uraian tentang kelurahan belum diisi.',
            'welcome_message' => '[DATA CONTOH] Sambutan Lurah belum diisi.',
            'history' => '[DATA CONTOH] Sejarah kelurahan belum diisi.',
            'vision' => '[DATA CONTOH] Visi kelurahan belum diisi.',
            'mission' => '[DATA CONTOH] Misi kelurahan belum diisi.',
            'geography' => '[DATA CONTOH] Kondisi geografis belum diisi.',
            'area_km2' => null,
            'boundary_north' => '[DATA CONTOH] Batas utara belum diisi',
            'boundary_south' => '[DATA CONTOH] Batas selatan belum diisi',
            'boundary_east' => '[DATA CONTOH] Batas timur belum diisi',
            'boundary_west' => '[DATA CONTOH] Batas barat belum diisi',
            'address' => '[DATA CONTOH] Alamat kantor belum diisi.',
            'district' => 'Kecamatan Contoh',
            'regency' => 'Kota Contoh',
            'province' => 'Provinsi Contoh',
            'postal_code' => null,
            'phone' => null,
            'whatsapp' => null,
            'email' => null,
            'office_hours' => '[DATA CONTOH] Jam pelayanan belum diisi.',
            'map_embed_url' => null,
            'map_url' => null,
        ]);
    }
}