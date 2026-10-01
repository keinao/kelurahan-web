<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'welcome_message',
        'history',
        'vision',
        'mission',
        'geography',
        'area_km2',
        'boundary_north',
        'boundary_south',
        'boundary_east',
        'boundary_west',
        'address',
        'district',
        'regency',
        'province',
        'postal_code',
        'phone',
        'whatsapp',
        'email',
        'office_hours',
        'map_embed_url',
        'map_url',
    ];

    protected function casts(): array
    {
        return [
            'area_km2' => 'decimal:2',
        ];
    }
}