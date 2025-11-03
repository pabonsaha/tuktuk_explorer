<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function details($slug)
    {
        $tour = Tour::where('slug', $slug)->with('images', 'additional', 'hours')->first();
        return view('tour.details', compact('tour'));
    }
}
