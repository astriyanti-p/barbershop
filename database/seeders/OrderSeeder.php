<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'customer_id'     => 3,
            'barber_id'       => 2,
            'order_code'      => 'ORD-20260429-001',
            'order_type'      => 'mixed',
            'total_amount'    => 125000,

            'payment_status'  => 'paid',
            'payment_method'  => 'qris',
            'payment_gateway' => 'midtrans',
            'transaction_id'  => 'MIDTRANS-TX-001',
            'snap_token'      => 'dummy_snap_token_123456',
            'redirect_url'    => 'https://app.midtrans.com/snap/v2/vtweb/dummy-url',
            'paid_at'         => now(),

            'status'          => 'confirmed',

            'booking_date'    => now()->addDay()->toDateString(),
            'booking_time'    => '14:00:00',

            'notes'           => 'Customer requests modern fade cut',
        ]);
    }
}