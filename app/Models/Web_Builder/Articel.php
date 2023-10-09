<?php

namespace App\Models\Web_Builder;
use App\Models\User;
use App\Traits\Uuid;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articel extends Model
{
    use HasFactory, Uuid;
    protected $table = 'articel_web_builder';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
