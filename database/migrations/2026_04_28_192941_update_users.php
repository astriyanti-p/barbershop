<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->unique()->after('name');
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('phone', 15)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('otp_code', 6)->nullable();
            $table->timestamp('otp_expiry')->nullable();
            $table->enum('role', ['admin', 'customer', 'barber'])->default('customer');
            $table->boolean('status')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'google_id',
                'phone',
                'address',
                'photo',
                'otp_code',
                'otp_expiry',
                'role',
                'status'
            ]);
        });
    }
};