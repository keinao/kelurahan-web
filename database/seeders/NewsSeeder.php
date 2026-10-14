<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        if (News::query()->exists()) {
            return;
        }

        // Jika Faker tersedia (development), gunakan factory
        if (class_exists(\Faker\Factory::class)) {
            News::factory()->published()->count(12)->create();
            News::factory()->draft()->count(3)->create();

            return;
        }

        // Data berita awal untuk production tanpa dependency Faker
        News::create([
            'title' => 'Penyaluran Program Bantuan Pangan Masyarakat di Kelurahan Kinilow',
            'slug' => 'penyaluran-program-bantuan-pangan-masyarakat-di-kelurahan-kinilow',
            'excerpt' => 'Pemerintah Kelurahan Kinilow menyalurkan bantuan pangan kepada warga masyarakat yang membutuhkan.',
            'content' => 'Pemerintah Kelurahan Kinilow Kecamatan Tomohon Utara telah melaksanakan kegiatan penyaluran bantuan pangan kepada masyarakat penerima manfaat. Kegiatan ini berlangsung dengan tertib dan lancar di Balai Kelurahan Kinilow.',
            'category' => 'kegiatan',
            'published_at' => now(),
            'is_published' => true,
        ]);

        News::create([
            'title' => 'Kerja Bakti Bersama dan Penataan Lingkungan Kelurahan Kinilow',
            'slug' => 'kerja-bakti-bersama-dan-penataan-lingkungan-kelurahan-kinilow',
            'excerpt' => 'Aparat kelurahan bersama masyarakat melaksanakan kerja bakti pembersihan saluran drainase dan jalan utama.',
            'content' => 'Dalam rangka menciptakan lingkungan yang bersih, sehat, dan nyaman, seluruh jajaran Pemerintah Kelurahan Kinilow bersama masyarakat menggelar kerja bakti massal di sepanjang jalan protokol dan fasilitas umum.',
            'category' => 'pengumuman',
            'published_at' => now()->subDays(3),
            'is_published' => true,
        ]);
    }
}