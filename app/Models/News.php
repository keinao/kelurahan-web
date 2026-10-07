<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

        /**
     * Pilihan kategori. Dipakai form admin dan filter website publik.
     *
     * @var array<string, string>
     */
    public const CATEGORIES = [
        'berita' => 'Berita',
        'pengumuman' => 'Pengumuman',
        'kegiatan' => 'Kegiatan',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'published_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where('published_at', '<=', now());
    }
}