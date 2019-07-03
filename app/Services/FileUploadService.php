<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileUploadService {

    /**
     * @param UploadedFile $file
     * @param $width
     * @param $heigth
     * @param $folder
     * @param string $mimeType
     * @return string
     */
    public function uploadS3(UploadedFile $file, $width, $heigth, $folder, $mimeType = 'jpg') {

        $resizedImage = Image::make($file)->fit($width, $heigth)->encode($mimeType);

        $hash = md5($resizedImage->__toString());

        Storage::disk('s3')->put($folder . '/' . $hash . '.' . $mimeType, (string)$resizedImage);

        $path = $folder . "/" . $hash . '.' . $mimeType;

        return $path;
    }
}
