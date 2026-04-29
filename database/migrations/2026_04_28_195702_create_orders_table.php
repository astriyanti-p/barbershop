<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('barber_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // kode order internal
            $table->string('order_code')->unique();

            $table->enum('order_type', ['booking', 'product', 'mixed'])
                  ->default('booking');

            $table->decimal('total_amount', 12, 2)->default(0);

            // payment info
            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'expired',
                'cancelled'
            ])->default('pending');

            $table->string('payment_method')->nullable();
            $table->string('payment_gateway')->default('midtrans');
            $table->string('transaction_id')->nullable();
            $table->string('snap_token')->nullable();
            $table->text('redirect_url')->nullable();
            $table->timestamp('paid_at')->nullable();

            // status order
            $table->enum('status', [
                'pending',
                'confirmed',
                'completed',
                'cancelled'
            ])->default('pending');

            // booking info
            $table->date('booking_date')->nullable();
            $table->time('booking_time')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};