<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getFilePath')) {
    function getFilePath($path)
    {
        if ($path && Storage::exists($path)) {
            return asset('storage/' . $path);
        }
        return asset('/assets/img/placeholder/placeholder.png');
    }
}

function getPriceFormat($amount)
{
    return '€' . number_format($amount, 2);
}
