<?php

namespace App\Models;
use App\Models\Cart;
use App\Traits\Uuid;
use App\Models\Categories;
use App\Models\Testimonial;
use App\Models\Web_Builder\Galeri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vespa extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $with = ['testimoni'];
    protected $table = 'products_vespa';

    protected $casts = [
        'photo_product' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function testimoni()
    {
        return $this->hasMany(Testimonial::class, 'product_id');
    }

    public function gambar_galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['cari'] ?? false, function ($query, $search) {
            return $query->where('name_product', 'like', '%' . $search . '%')
                ->orWhere('launch_year', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($query) use ($search) {
                    return $query->where('name_category', 'like', '%' . $search . '%')
                        ->orWhere('slug', $search);
                });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });
    }
}
