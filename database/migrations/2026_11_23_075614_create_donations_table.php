<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('food_type'); // Makanan Berat, Roti & Kue, Bahan Mentah, Buah & Sayur, Minuman, Lainnya
            $table->string('quantity');
            $table->string('delivery_method')->default('Ambil Sendiri'); // Ambil Sendiri, Diantar Pendonasi, Jemput Terjadwal
            $table->string('location');
            $table->text('pickup_address');
            $table->string('pic_name');
            $table->string('pic_contact');
            $table->dateTime('deadline');
            $table->text('allergen_notes')->nullable();
            $table->text('storage_notes')->nullable();
            $table->string('image_url')->nullable();
            $table->enum('status', ['urgent', 'available', 'claimed', 'completed', 'expired'])->default('available');
            $table->foreignId('claimed_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
