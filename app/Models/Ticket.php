<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'payment_id',
        'payment_status',
        'is_paid'
    ];

    protected $casts = [
        'is_paid' => 'boolean'
    ];
}