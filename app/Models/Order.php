<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'barber_id',
        'order_code',
        'order_type',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_gateway',
        'transaction_id',
        'snap_token',
        'redirect_url',
        'paid_at',
        'status',
        'booking_date',
        'booking_time',
        'notes'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function barber()
    {
        return $this->belongsTo(User::class, 'barber_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}