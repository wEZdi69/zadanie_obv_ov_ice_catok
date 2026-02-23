<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skate extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'brand',
        'size',
        'quantity',
        'description',
        'image'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}