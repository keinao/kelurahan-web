<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{
    protected $fillable = [
        'year',
        'total_population',
        'male_population',
        'female_population',
        'total_families',
        'total_lingkungan',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'total_population' => 'integer',
            'male_population' => 'integer',
            'female_population' => 'integer',
            'total_families' => 'integer',
            'total_lingkungan' => 'integer',
        ];
    }
}