<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'slug', 'icon', 'color', 'image', 'subtitle', 'description', 'grades', 'roadmap', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'grades' => 'array',
            'roadmap' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
