<?php

namespace App\Models\Web_Builder;
use App\Traits\Uuid;
use App\Models\Vespa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $table = 'galeri_web_builder';

    public function product_vespa()
    {
        return $this->belongsTo(Vespa::class, 'product_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
