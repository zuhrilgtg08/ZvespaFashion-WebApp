<?php

namespace App\Models;
use App\Models\Cart;
use App\Traits\Uuid;
use App\Models\Cities;
use App\Models\Provinces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function province()
    {
        return $this->belongsTo(Provinces::class, 'province_id');
    }

    public function cities()
    {
        return $this->belongsTo(Cities::class, 'destination_id');
    }
}
