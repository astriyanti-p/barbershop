<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarberProfile extends Model
{
    protected $fillable = [
        'user_id','shop_name','bio','latitude','longitude','rating'
    ];

    protected $attributes = [
        'rating' => 0
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'rating' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}