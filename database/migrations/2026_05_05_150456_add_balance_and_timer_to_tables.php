<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menyuntikkan kolom balance ke tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 12, 2)->default(0)->after('status');
        });

        // Menyuntikkan kolom service_started_at ke tabel orders
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('service_started_at')->nullable()->after('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom jika migration di-rollback
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('service_started_at');
        });
    }
};
