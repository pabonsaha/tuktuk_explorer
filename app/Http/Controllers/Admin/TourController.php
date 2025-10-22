<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    //

    public function index()
    {
        $tours = Tour::latest()->paginate(10);
        return view('admin.tour.index', compact('tours'));
    }
}
