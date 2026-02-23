<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Skate;
use App\Models\Ticket;
use Illuminate\Http\Request;
use YooKassa\Client;

class BookingController extends Controller
{
    private const TICKET_PRICE = 300;
    private const SKATE_PRICE_PER_HOUR = 150;

    public function showBookingForm()
    {
        $skates = Skate::where('quantity', '>', 0)->get();
        return view('booking', compact('skates'));
    }

    public function showTicketForm()
    {
        return view('ticket');
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'hours' => 'required|in:1,2,3,4',
            'has_skates' => 'sometimes|boolean',
            'skate_id' => 'required_if:has_skates,1|exists:skates,id',
            'skate_size' => 'required_if:has_skates,1|integer|min:30|max:47'
        ]);

        // Расчет стоимости
        $totalAmount = self::TICKET_PRICE;
        
        if ($request->has('has_skates') && $request->has_skates) {
            $totalAmount += self::SKATE_PRICE_PER_HOUR * $request->hours;
        }

        // Создание бронирования
        $booking = Booking::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'hours' => $request->hours,
            'has_skates' => $request->has('has_skates') ? true : false,
            'skate_id' => $request->skate_id,
            'skate_size' => $request->skate_size,
            'total_amount' => $totalAmount,
            'payment_status' => 'pending'
        ]);

        // Создание платежа в ЮKassa
        try {
            $client = new Client();
            $client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));

            $payment = $client->createPayment(
                [
                    'amount' => [
                        'value' => $totalAmount,
                        'currency' => 'RUB',
                    ],
                    'confirmation' => [
                        'type' => 'redirect',
                        'return_url' => route('payment.success'),
                    ],
                    'capture' => true,
                    'description' => 'Оплата бронирования катка',
                    'metadata' => [
                        'booking_id' => $booking->id
                    ],
                ],
                uniqid('', true)
            );

            $booking->update([
                'payment_id' => $payment->getId()
            ]);

            return redirect($payment->getConfirmation()->getConfirmationUrl());

        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при создании платежа: ' . $e->getMessage());
        }
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20'
        ]);

        $ticket = Ticket::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment_status' => 'pending'
        ]);

        try {
            $client = new Client();
            $client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));

            $payment = $client->createPayment(
                [
                    'amount' => [
                        'value' => self::TICKET_PRICE,
                        'currency' => 'RUB',
                    ],
                    'confirmation' => [
                        'type' => 'redirect',
                        'return_url' => route('payment.success'),
                    ],
                    'capture' => true,
                    'description' => 'Оплата входного билета на каток',
                    'metadata' => [
                        'ticket_id' => $ticket->id
                    ],
                ],
                uniqid('', true)
            );

            $ticket->update([
                'payment_id' => $payment->getId()
            ]);

            return redirect($payment->getConfirmation()->getConfirmationUrl());

        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при создании платежа: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('payment-success');
    }
}