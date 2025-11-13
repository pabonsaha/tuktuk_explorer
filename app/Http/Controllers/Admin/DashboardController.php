<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function index(){
        $totalBookings = Booking::count();
        $completeBookings = Booking::where('tour_status',2)->count();
        $totalBookingMoney = Booking::where('tour_status','!=',0)->where('active_status','1')->sum('total_price');

        $stats = DB::table('bookings')
            ->selectRaw('MONTH(tour_date) as month, COUNT(*) as total')
            ->whereYear('tour_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        return view('admin.dashboard',compact('totalBookings','completeBookings','totalBookingMoney'));
    }

    public function yearlyBookings(){
        $stats = DB::table('bookings')
            ->selectRaw('MONTH(tour_date) as month, COUNT(*) as total')
            ->whereYear('tour_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $fullStats = [];
        for ($i = 1; $i <= 12; $i++) {
            $fullStats[] = $stats[$i] ?? 0;
        }

        return response()->json($fullStats);
    }
}
