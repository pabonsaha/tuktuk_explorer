<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Tour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){
        $banners = Banner::where('is_active',1)->get();
        $tours = Tour::where('is_active',1)->get();
        return view('home',compact('banners','tours'));
    }


    public function about()
    {
        return view('about');
    }
}
