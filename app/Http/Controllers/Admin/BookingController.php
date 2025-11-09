<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('search')) {
            $query->where('code', 'like', "%{$request->search}%")
                ->orWhere('code', 'like', "%{$request->search}%");
        }

        if ($request->filled('tour_status')) {
            $query->where('tour_status', $request->tour_status);
        }

        if ($request->filled('active_status')) {
            $query->where('active_status', $request->active_status);
        }

        $bookings = $query->latest()->paginate(15);
        return view('admin.booking.index', compact('bookings'));
    }

    public function details($id){
        $booking = Booking::find($id);
        return response()->json($booking);
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->{$request->field} = $request->value;
        $booking->save();

        return response()->json(['message' => ucfirst(str_replace('_', ' ', $request->field)) . ' updated successfully.']);
    }
}
