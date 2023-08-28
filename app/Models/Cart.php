<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
}
