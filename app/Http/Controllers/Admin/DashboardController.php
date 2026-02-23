<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Skate;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_skates' => Skate::count(),
            'total_bookings' => Booking::count(),
            'paid_bookings' => Booking::where('is_paid', true)->count(),
            'total_tickets' => Ticket::where('is_paid', true)->count(),
            'recent_bookings' => Booking::with('skate')->latest()->take(5)->get(),
            'recent_tickets' => Ticket::latest()->take(5)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}