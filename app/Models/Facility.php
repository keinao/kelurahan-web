<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
        /**
     * Pilihan kategori. Dipakai form admin dan filter website publik.
     *
     * @var array<string, string>
     */
    public const CATEGORIES = [
        'kantor' => 'Kantor Kelurahan',
        'sekolah' => 'Sekolah',
        'kesehatan' => 'Fasilitas Kesehatan',
        'posyandu' => 'Posyandu',
        'ibadah' => 'Tempat Ibadah',
        'lapangan' => 'Lapangan',
        'pasar' => 'Pasar',
        'lainnya' => 'Lainnya',
        'penginapan' => 'Penginapan',
        'kuliner' => 'Kuliner',
        'wisata-alam' => 'Wisata Alam',
    ];
    
    protected $fillable = [
        'name',
        'category',
        'address',
        'description',
        'map_url',
        'is_active',
        'slug',
        'photos',
        'subtitle',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'photos' => 'array',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}