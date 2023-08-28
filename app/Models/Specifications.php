<?php

namespace App\Models;
use App\Traits\Uuid;
use App\Models\Vespa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specifications extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $table = 'specifications';

    public function vespa()
    {
        return $this->belongsTo(Vespa::class, 'product_id');
    }
}
