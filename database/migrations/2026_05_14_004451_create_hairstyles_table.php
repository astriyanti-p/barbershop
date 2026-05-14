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
        Schema::create('hairstyles', function (Blueprint $table) {
            $table->id();
            // 🔥 Ini kabel penghubungnya ke tabel face_shapes
            $table->foreignId('face_shape_id')->constrained('face_shapes')->onDelete('cascade');

            $table->string('name'); // Contoh: Textured French Crop
            $table->string('category'); // Contoh: PENDEK / KLASIK
            $table->string('image'); // Nama file gambar
            $table->text('description')->nullable(); // Penjelasan gaya rambut
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hairstyles');
    }
};
