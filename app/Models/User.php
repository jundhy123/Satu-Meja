<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin, pendonasi, penerima
        'status', // pending, verified, rejected
        'institution_name',
        'category',
        'pic_name',
        'phone',
        'address',
        'description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getOrgNameAttribute(): string
    {
        return $this->institution_name ?? $this->name;
    }

    public function getKategoriAttribute(): string
    {
        return $this->category ?? 'Lembaga/Usaha';
    }

    public function getPicAttribute(): string
    {
        return $this->pic_name ?? $this->name;
    }

    public function getTeleponAttribute(): string
    {
        return $this->phone ?? '-';
    }

    public function getAlamatAttribute(): string
    {
        return $this->address ?? '-';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPendonasi(): bool
    {
        return $this->role === 'pendonasi' || $this->role === 'pemberi';
    }

    public function isPenerima(): bool
    {
        return $this->role === 'penerima';
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'user_id');
    }

    public function claimedDonations()
    {
        return $this->hasMany(Donation::class, 'claimed_by_user_id');
    }

    public function sentThankYous()
    {
        return $this->hasMany(ThankYou::class, 'sender_id');
    }

    public function receivedThankYous()
    {
        return $this->hasMany(ThankYou::class, 'donor_id');
    }
}
