<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getFilePath')) {
    function getFilePath($path, $placeholder = '/assets/img/placeholder/placeholder.png')
    {
        if ($path && Storage::exists($path)) {
            return asset('storage/' . $path);
        }
        return asset($placeholder);
    }
}

function getPriceFormat($amount)
{
    return '€' . number_format($amount, 2);
}
