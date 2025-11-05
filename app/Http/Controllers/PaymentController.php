<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Service\StripeService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payStripe(Request $request)
    {

        $metadata = [];
        $metadata['tour_title'] = $request->tourTitle;
        $metadata['total_price'] = $request->totalPrice;
        $metadata['per_pessenger_price'] = $request->perPassengerPrice;
        $metadata['total_passenger_price'] = $request->passengerPrice;
        $metadata['time'] = $request->time;
        $metadata['date'] = $request->date;
        $metadata['passenger'] = $request->passenger;
        $metadata['hour'] = json_decode($request->hour)->title;
        $metadata['contact_form'] = $request->contact_form;
        $additionalsData = [];
        $loop = 0;
        foreach (json_decode($request->additionals) as $key => $value) {
            if ($value->count > 0) {
                $additionalsData[$loop]['title'] = $value->title;
                $additionalsData[$loop]['price'] = $value->price;
                $additionalsData[$loop]['count'] = $value->count;
                $loop++;
            }
        }

        $metadata['additionals'] = json_encode($additionalsData);

        $stripe = new StripeService();
        $result = $stripe->pay($request->tourTitle, $request->totalPrice, $metadata);
        return response()->json([
            'success' => true,
            'redirect_url' => $result,
            'message' => 'Redirecting to payment...'
        ]);
    }

    public function successPayment(Request $request)
    {

        $stripe = new StripeService();
        $data = $stripe->successPayment($request->session_id);
        $metadata = $data['metadata'];
        if (Booking::where('payment_invoice_id', $data['payment_intent_id'])->exists()) {
            return view('payment.success', [
                'message' => 'Payment already confirmed ✅'
            ]);
        }

        $booking = new Booking();
        $booking->title = $metadata->tour_title;
        $booking->hour = $metadata->hour;
        $booking->passengers = $metadata->passenger;
        $booking->additionals = $metadata->additionals;
        $booking->tour_date = $metadata->date;
        $booking->tour_time = $metadata->time;
        $booking->per_pessenger_price = $metadata->per_pessenger_price;
        $booking->passenger_price = $metadata->total_passenger_price;
        $booking->total_price = $data['amount_total'];
        $booking->currency = $data['currency'];
        $booking->customer_name = json_decode($metadata->contact_form)->fullName;
        $booking->customer_email = json_decode($metadata->contact_form)->email;
        $booking->customer_phone = json_decode($metadata->contact_form)->phone;
        $booking->customer_country = json_decode($metadata->contact_form)->country;
        $booking->payment_customer_info = json_encode($data['customer_details']);
        $booking->payment_invoice_id = $data['payment_intent_id'];
        $booking->payment_status = $data['payment_status'];
        $booking->active_status = 1;
        $booking->tour_status = 1;

        $booking->save();

        return view('payment.success', [
            'message' => 'Payment have been confirmed.'
        ]);


    }
}
