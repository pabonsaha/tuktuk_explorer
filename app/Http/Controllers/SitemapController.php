<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = "https://lisbontuktukexplorer.com";

        $urls = [
            ['loc' => $baseUrl, 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => $baseUrl.'/explore', 'changefreq' => 'weekly', 'priority' => '0.9'],
        ];

        $tours = DB::table('tours')->pluck('slug');

        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $u) {
            echo "<url><loc>{$u['loc']}</loc><changefreq>{$u['changefreq']}</changefreq><priority>{$u['priority']}</priority></url>";
        }

        foreach ($tours as $slug) {
            echo "<url><loc>{$baseUrl}/place/{$slug}</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>";
        }

        echo '</urlset>';
    }
}