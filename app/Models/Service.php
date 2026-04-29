<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Service extends Model
{
    protected $fillable = [
        'barber_id',
        'name',
        'description',
        'price',
        'duration',
        'photo',
        'status'
    ];

    public function barber()
    {
        return $this->belongsTo(User::class, 'barber_id');
    }
}