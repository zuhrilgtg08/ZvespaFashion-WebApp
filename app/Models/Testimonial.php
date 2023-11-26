<?php

namespace App\Models;
use App\Models\User;
use App\Models\Vespa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'testimonial';
    protected $with = ['customer', 'vespa'];

    public function vespa()
    {
        return $this->belongsTo(Vespa::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
