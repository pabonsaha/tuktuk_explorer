<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\Tour;
use App\Service\StripeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
            $result = $stripe->pay($request->tourTitle, $request->totalPrice, $data->toArray());
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
                    'exception' => $e->getMessage(),
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
        $payload = $data instanceof Collection ? $data : collect((array)$data);
        $contactForm = json_decode((string)$payload->get('contact_form', '{}'), true) ?? [];

        $booking = new Booking();
        $booking->code = self::generateBookingId();
        $booking->title = $payload->get('tour_title');
        $booking->hour = $payload->get('hour');
        $booking->passengers = $payload->get('passenger');
        $booking->additionals = $payload->get('additionals');
        $booking->tour_date = $payload->get('date');
        $booking->tour_time = $payload->get('time');
        $booking->per_pessenger_price = $payload->get('per_pessenger_price');
        $booking->passenger_price = $payload->get('total_passenger_price');
        $booking->total_price = $payload->get('amount_total', $payload->get('total_price'));
        $booking->currency = $payload->get('currency');
        $booking->customer_name = $contactForm['fullName'] ?? null;
        $booking->customer_email = $contactForm['email'] ?? null;
        $booking->customer_phone = $contactForm['phone'] ?? null;
        $booking->customer_country = $contactForm['country'] ?? null;
        $booking->active_status = 1;
        $booking->tour_status = 1;
        $booking->save();

        return $booking;
    }

    public function prepareBookingData($request): Collection
    {
        $metadata = collect([
            'tour_title' => $request->tourTitle,
            'total_price' => $request->totalPrice,
            'per_pessenger_price' => $request->perPassengerPrice,
            'total_passenger_price' => $request->passengerPrice,
            'time' => $request->time,
            'date' => $request->date,
            'passenger' => $request->passenger,
            'hour' => optional(json_decode($request->hour))->title,
            'contact_form' => $request->contact_form,
        ]);

        $additionals = collect(json_decode($request->additionals))
            ->filter(fn($item) => $item->count > 0)
            ->map(fn($item) => [
                'title' => $item->title,
                'price' => $item->price,
                'count' => $item->count,
            ])
            ->values()
            ->toArray();

        $metadata->put('additionals', json_encode($additionals));

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
