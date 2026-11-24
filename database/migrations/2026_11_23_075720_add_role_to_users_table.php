<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'pendonasi', 'penerima'])->default('pendonasi')->after('email');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->after('role');
            }
            if (!Schema::hasColumn('users', 'institution_name')) {
                $table->string('institution_name')->nullable()->after('status');
            }
            if (!Schema::hasColumn('users', 'category')) {
                $table->string('category')->nullable()->after('institution_name');
            }
            if (!Schema::hasColumn('users', 'pic_name')) {
                $table->string('pic_name')->nullable()->after('category');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('pic_name');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'description')) {
                $table->text('description')->nullable()->after('address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'institution_name', 'category', 'pic_name', 'phone', 'address', 'description']);
        });
    }
};
