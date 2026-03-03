<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\Tour;
use App\Service\StripeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TourController extends Controller
{
    public function details($slug)
    {
        $tour = Tour::where('slug', $slug)->with('images', 'additional', 'hours')->first();
        return view('tour.details', compact('tour'));
    }

    public function booking(Request $request)
    {
        try {

            $data = $this->prepareBookingData($request);
            $stripe = new StripeService();
            $result = $stripe->pay($request->tourTitle, $request->totalPrice, $data);
            return response()->json([
                'success' => true,
                'redirect_url' => $result,
                'message' => 'Redirecting to payment...'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function bookingWithoutPayment(Request $request)
    {
        try {
            $data = $this->prepareBookingData($request);
            $booking = $this->storeBooking($data);
            $this->sendBookingConfirmationEmail($booking);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('tour.bookingSuccess', ['booking' => $booking->id]),
                    'message' => 'Booking confirmed successfully.'
                ]);
            }

            return view('tour.success', compact('booking'));

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong, Please contact with authority'
                ], 500);
            }

            return redirect()->route('home')->with('error', 'Something went wrong, Please contact with authority');
        }
    }

    public function bookingSuccess(Booking $booking)
    {
        return view('tour.success', compact('booking'));
    }

    public static function storeBooking($data)
    {
        $booking = new Booking();
        $booking->code = self::generateBookingId();
        $booking->title = $data->tour_title;
        $booking->hour = $data->hour;
        $booking->passengers = $data->passenger;
        $booking->additionals = $data->additionals;
        $booking->tour_date = $data->date;
        $booking->tour_time = $data->time;
        $booking->per_pessenger_price = $data->per_pessenger_price;
        $booking->passenger_price = $data->total_passenger_price;
        $booking->total_price = $data['amount_total'] ?? $data->total_price;
        $booking->currency = $data['currency'] ?? null;
        $booking->customer_name = json_decode($data->contact_form)->fullName;
        $booking->customer_email = json_decode($data->contact_form)->email;
        $booking->customer_phone = json_decode($data->contact_form)->phone;
        $booking->customer_country = json_decode($data->contact_form)->country;
        $booking->active_status = 1;
        $booking->tour_status = 1;
        $booking->save();

        return $booking;
    }

    public function prepareBookingData($request)
    {
        $metadata = [
            'tour_title' => $request->tourTitle,
            'total_price' => $request->totalPrice,
            'per_pessenger_price' => $request->perPassengerPrice,
            'total_passenger_price' => $request->passengerPrice,
            'time' => $request->time,
            'date' => $request->date,
            'passenger' => $request->passenger,
            'hour' => optional(json_decode($request->hour))->title,
            'contact_form' => $request->contact_form,
        ];

        $additionals = collect(json_decode($request->additionals))
            ->filter(fn($item) => $item->count > 0)
            ->map(fn($item) => [
                'title' => $item->title,
                'price' => $item->price,
                'count' => $item->count,
            ])
            ->values()
            ->toArray();

        $metadata['additionals'] = json_encode($additionals);

        return $metadata;
    }


    public static function sendBookingConfirmationEmail($data)
    {
        try {
            Mail::to($data->customer_email)->send(new BookingConfirmationMail($data));
            Mail::raw('🚀New Tour Booked In Tuktuk Explorer.', function ($message) {
                $message->to('riazuddin3400@gmail.com')
                    ->subject('Tuktuk New Booking');
            });

        } catch (Exception $e) {
            Log::error('Mail send failed: ' . $e->getMessage());
        }
    }

    public static function generateBookingId($prefix = 'TTE')
    {
        $unique = strtoupper(dechex(time() % 100000)) . random_int(10, 99);
        return $prefix . '-' . $unique;
    }
}
