<?php

namespace App\Models;

use App\Models\Vespa;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $table = 'categories';

    public function vespa()
    {
        return $this->hasMany(Vespa::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
