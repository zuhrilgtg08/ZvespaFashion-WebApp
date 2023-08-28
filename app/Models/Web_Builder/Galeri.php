<?php

namespace App\Models\Web_Builder;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
}
