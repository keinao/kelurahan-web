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

        // 12 terbit + 3 draft = 15 data untuk menguji pagination,
        // kategori, status terbit/draft, urutan, dan pencarian.
        News::factory()->published()->count(12)->create();
        News::factory()->draft()->count(3)->create();
    }
}