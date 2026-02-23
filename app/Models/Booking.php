<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'hours',
        'has_skates',
        'skate_id',
        'skate_size',
        'total_amount',
        'payment_id',
        'payment_status',
        'is_paid'
    ];

    protected $casts = [
        'has_skates' => 'boolean',
        'is_paid' => 'boolean'
    ];

    public function skate()
    {
        return $this->belongsTo(Skate::class);
    }
}