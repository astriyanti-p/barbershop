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
        Schema::create('face_shapes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Wajah Bulat
            $table->text('description'); // Penjelasan singkat
            $table->string('suggestions'); // Contoh: Pompadour, Quiff
            $table->string('icon')->nullable(); // Nama file icon di storage
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('face_shapes');
    }
};
