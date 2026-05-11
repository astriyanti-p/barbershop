<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'barber_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    // Produk milik BarberProfile
    public function barber()
    {
        return $this->belongsTo(BarberProfile::class, 'barber_id');
    }
}
