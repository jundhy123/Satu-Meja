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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('food_type');
            $table->string('quantity')->nullable();
            $table->string('location');
            $table->text('pickup_address');
            $table->string('pic_name');
            $table->string('pic_contact');
            $table->dateTime('deadline');
            $table->enum('status', ['available', 'claimed', 'completed', 'expired'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};