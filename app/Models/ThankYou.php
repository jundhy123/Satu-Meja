<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThankYou extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'sender_id',
        'donor_id',
        'message',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }
}
