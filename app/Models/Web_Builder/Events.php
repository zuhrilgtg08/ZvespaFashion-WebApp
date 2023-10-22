<?php

namespace App\Models\Web_Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $table = 'events_web_builder';

    protected $casts = [
        'photo_pameran' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
