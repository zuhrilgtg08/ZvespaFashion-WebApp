<?php

namespace App\Models;
use App\Models\User;
use App\Traits\Uuid;
use App\Models\Vespa;
use App\Models\Checkout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $with = ['product', 'kustomer'];

    public function product()
    {
        return $this->belongsTo(Vespa::class);
    }

    public function kustomer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_id');
    }
}
