<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


trait FileUploadTrait
{

    public function movedAsset($folder)
    {
        return 'uploads/' . $folder . '/';
    }

    public function assetUrl($folder, $asset_link)
    {
        return 'uploads/' . $folder . '/' . $asset_link;
    }


    public function deleteFile($path)
    {
        if ($path != null) {
            Storage::delete($path);
        }
    }


    public function uploadFile($file, $folder, $type = null, $height = 800)
    {
        $filePath = "";
        $rootDir = 'uploads/';
        if ($file) {
            $processedImage = Image::read($file)->toWebp(100);
            $fileName = $rootDir . $folder . '/' . uniqid() . '.webp';
            Storage::put($fileName, (string)$processedImage);
        }

        $filePath = $fileName;


        return $fileName;
    }

}
