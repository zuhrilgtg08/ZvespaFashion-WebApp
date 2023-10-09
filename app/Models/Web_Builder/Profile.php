<?php

namespace App\Models\Web_Builder;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'profile_web_builder';

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }
}
