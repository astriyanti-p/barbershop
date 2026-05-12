<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BarberProfile extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'bio',
        'latitude',
        'longitude',
        'rating'
    ];

    protected $attributes = [
        'rating' => 0
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'rating' => 'float',
    ];

    // RELASI KE USER (OWNER BARBERSHOP)
   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELASI PRODUK BARBER
    public function products()
    {
        return $this->hasMany(Product::class, 'barber_id');
    }

    // RELASI SERVICE BARBER
    public function services()
    {
        return $this->hasMany(Service::class, 'barber_id');
    }

    // RELASI JADWAL BARBER
    public function schedules()
    {
    return $this->hasMany(BarberSchedule::class,'barber_id');
    }
}
