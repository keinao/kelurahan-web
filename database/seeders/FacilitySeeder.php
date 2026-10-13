<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = json_decode(
            File::get(base_path('data/fasilitas.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        foreach ($facilities as $data) {
            $facility = Facility::query()->firstOrNew(['name' => $data['nama']]);
            $facility->slug ??= $data['slug'];
            $facility->category ??= $data['kategori'];
            $facility->map_url ??= $data['maps_url'];
            $facility->address ??= null;
            $facility->description ??= $data['deskripsi'];
            $facility->photos ??= $data['foto'];
            $facility->subtitle ??= $data['subtitle'];
            $facility->is_active ??= true;
            $facility->save();
        }
    }
}