<?php

namespace App\Models\Web_Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'about',
        'visi',
        'misi',
    ];
}
