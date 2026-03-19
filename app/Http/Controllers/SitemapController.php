<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = "https://lisbontuktukexplorer.com";

        $tours = DB::table('tours')->pluck('slug');

        return response()->view('sitemap', [
            'baseUrl' => $baseUrl,
            'tours' => $tours
        ])->header('Content-Type', 'application/xml');
    }
}