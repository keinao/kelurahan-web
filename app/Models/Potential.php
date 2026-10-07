<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
        /**
     * Pilihan kategori. Dipakai form admin dan filter website publik.
     *
     * @var array<string, string>
     */
    public const CATEGORIES = [
        'pertanian' => 'Pertanian',
        'umkm' => 'UMKM',
        'kuliner' => 'Kuliner',
        'kerajinan' => 'Kerajinan',
        'wisata' => 'Wisata',
        'perikanan' => 'Perikanan',
        'budaya' => 'Budaya',
        'lainnya' => 'Lainnya',
    ];
    
    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'location',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}