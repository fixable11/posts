<?php

declare(strict_types=1);

namespace App\Filesystem;

use Exception;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageUploader.
 */
class ImageUploader
{
    /**
     * Upload image in base64 format.
     *
     * @param string $file Image.
     *
     * @return string|null
     * @throws Exception
     */
    public function uploadBase64Image(?string $file)
    {
        if ($file === null || !preg_match('/^data:image\/(\w+);base64,/', $file, $type)) {
            return $file;
        }

        $data = substr($file, strpos($file, ',') + 1);
        $type = strtolower($type[1]);

        if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
            throw new Exception('invalid image type');
        }

        $data = base64_decode($data);

        if ($data === false) {
            throw new Exception('base64_decode failed');
        }

        $fileName = uniqid(). '.'. $type;
        Storage::put(config('app.images_path') . $fileName, $data);

        return config('app.public_images_path') . $fileName;
    }
}
