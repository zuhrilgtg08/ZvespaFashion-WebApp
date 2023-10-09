<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cities;
use App\Models\Provinces;
use App\Models\Testimonial;
use App\Models\Web_Builder\Articel;
use App\Models\Web_Builder\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'roles_type',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinces::class, 'u_prov_id');
    }

    public function kota()
    {
        return $this->belongsTo(Cities::class, 'u_kota_id');
    }

    public function testimonial()
    {
        return $this->hasMany(Testimonial::class, 'user_id');
    }

    public function artikel()
    {
        return $this->hasMany(Articel::class, 'user_id');
    }

    public function profile_webBuilder()
    {
        return $this->hasMany(Profile::class, 'karyawan_id');
    }
}
