<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Nomor urut untuk judul agar mudah dibedakan.
     */
    protected static int $number = 0;

    public function definition(): array
    {
        $title = 'Informasi Contoh ' . ++static::$number;

        return [
            'title' => $title,
            // Akhiran acak menjamin slug unik walau seeder dijalankan berulang.
            'slug' => Str::slug($title) . '-' . Str::lower(Str::random(5)),
            'category' => fake()->randomElement(['berita', 'pengumuman', 'kegiatan']),
            'content' => '<p>[DATA CONTOH] Ini informasi contoh untuk menguji tampilan website. Bukan informasi resmi kelurahan.</p>'
                . '<p>[DATA CONTOH] ' . fake()->paragraph(3) . '</p>',
            'published_at' => fake()->dateTimeBetween('-60 days', '-1 day'),
            'is_published' => true,
        ];
    }

    /**
     * Sudah terbit, tanggal terbit di masa lalu.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-60 days', '-1 day'),
        ]);
    }

    /**
     * Draft: belum terbit dan belum bertanggal.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }
}