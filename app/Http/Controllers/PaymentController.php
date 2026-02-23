<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use YooKassa\Client;

class PaymentController extends Controller
{
    public function webhook(Request $request)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);

        if (isset($requestBody['event']) && $requestBody['event'] === 'payment.waiting_for_capture') {
            $paymentId = $requestBody['object']['id'];
            
            $client = new Client();
            $client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));

            try {
                $payment = $client->capturePayment([
                    'amount' => $requestBody['object']['amount'],
                ], $paymentId);

                // Обновление статуса бронирования или билета
                $metadata = $requestBody['object']['metadata'] ?? [];
                
                if (isset($metadata['booking_id'])) {
                    $booking = Booking::find($metadata['booking_id']);
                    if ($booking) {
                        $booking->update([
                            'payment_status' => 'succeeded',
                            'is_paid' => true
                        ]);
                    }
                } elseif (isset($metadata['ticket_id'])) {
                    $ticket = Ticket::find($metadata['ticket_id']);
                    if ($ticket) {
                        $ticket->update([
                            'payment_status' => 'succeeded',
                            'is_paid' => true
                        ]);
                    }
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}