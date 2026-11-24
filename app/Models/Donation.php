<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'food_type',
        'quantity',
        'delivery_method',
        'location',
        'pickup_address',
        'pic_name',
        'pic_contact',
        'deadline',
        'allergen_notes',
        'storage_notes',
        'image_url',
        'status', // urgent, available, claimed, completed, expired
        'claimed_by_user_id',
        'claimed_at',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
            'claimed_at' => 'datetime',
        ];
    }

    public function getExpiresAtAttribute()
    {
        return $this->deadline;
    }

    public function getJenisLabelAttribute(): string
    {
        return match($this->food_type) {
            'makanan-matang', 'Makanan Berat' => 'Makanan Matang',
            'roti-kue', 'Roti & Kue' => 'Roti & Kue',
            'bahan-segar', 'Bahan Mentah' => 'Bahan Segar',
            'paket-nasi' => 'Paket Nasi',
            default => $this->food_type ?? 'Pangan Berlebih',
        };
    }

    /**
     * Accessor dynamic status based on rules:
     * - completed: status completed
     * - claimed: status claimed / claimed_by_user_id exists
     * - expired: deadline <= now
     * - urgent: remaining time < 48 hours
     * - available: otherwise
     */
    public function getComputedStatusAttribute(): string
    {
        if ($this->status === 'completed') {
            return 'completed';
        }

        if ($this->status === 'claimed' || $this->claimed_by_user_id) {
            return 'claimed';
        }

        if ($this->deadline && Carbon::now()->greaterThanOrEqualTo($this->deadline)) {
            return 'expired';
        }

        if ($this->deadline && Carbon::now()->diffInHours($this->deadline, false) < 48) {
            return 'urgent';
        }

        return 'available';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function claimedBy()
    {
        return $this->belongsTo(User::class, 'claimed_by_user_id');
    }

    public function thankYou()
    {
        return $this->hasOne(ThankYou::class, 'donation_id');
    }
}
