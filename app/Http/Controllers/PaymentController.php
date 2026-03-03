<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Service\StripeService;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function successPayment(Request $request)
    {
        try {
            $stripe = new StripeService();
            $data = $stripe->successPayment($request->session_id);
            if (Booking::where('payment_invoice_id', $data['payment_intent_id'])->exists()) {
                $booking = Booking::where('payment_invoice_id', $data['payment_intent_id'])->first();
                return view('tour.success', compact('booking'));
            }

            $metadata = $data['metadata'];
            $booking = TourController::storeBooking($metadata);
            $booking->payment_customer_info = json_encode($data['customer_details']);
            $booking->payment_invoice_id = $data['payment_intent_id'];
            $booking->payment_status = $data['payment_status'];
            $booking->save();

            TourController::sendBookingConfirmationEmail($booking);


            return view('tour.success', compact('booking'));

        } catch (Exception $e) {
            return route('home')->with('error', 'Something went wrong, Please contact with authority');
        }


    }

    public function errorPayment()
    {
        return view('tour.error');
    }


}
