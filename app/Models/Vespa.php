<?php

namespace App\Models;
use App\Traits\Uuid;
use App\Models\Categories;
use App\Models\Specifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vespa extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $table = 'products_vespa';

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specifications::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name_product', 'like', '%' . $search . '%')
                ->orWhere('launch_year', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($query) use ($search) {
                    return $query->where('name_category', 'like', '%' . $search . '%');
                })
                ->orWhereHas('specifications', function ($query) use ($search) {
                    return $query->where('type_model', 'like', '%' . $search . '%');
                });
        });
    }
}
