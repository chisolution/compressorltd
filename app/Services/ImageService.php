<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload and optionally resize an image.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param array|null $dimensions [width, height]
     * @return string Path to the uploaded image
     */
    public function uploadImage($file, $directory, $dimensions = null)
    {
        $this->validateImageType($file);

        $path = $file->store($directory, 'public');

        if ($dimensions) {            $fullPath = storage_path('app/public/' . $path);
            $image = $this->manager->read($fullPath);
            $image->resize(width: $dimensions[0], height: $dimensions[1]);
            $image->save($fullPath);
        }

        return $path;
    }

    /**
     * Delete an image.
     *
     * @param string $path
     * @return void
     */
    public function deleteImage($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Convert an image to webP format.
     *
     * @param string $path
     * @return string Path to the converted image
     */
    public function convertToWebP($path)
    {        $fullPath = storage_path('app/public/' . $path);
        $image = $this->manager->read($fullPath);

        $webPPath = preg_replace('/\.[^.]+$/', '.webp', $path);
        $webPFullPath = storage_path('app/public/' . $webPPath);

        $image->toWebp();
        $image->save($webPFullPath);

        $this->sanitizeWebP($webPPath);

        return $webPPath;
    }

    /**
     * Sanitize webP images for security reasons.
     *
     * @param string $path
     * @return void
     */
    private function sanitizeWebP($path)
    {        $fullPath = storage_path('app/public/' . $path);
        $image = $this->manager->read($fullPath);

        // Re-encode the webP image to ensure it is safe
        $image->toWebp();
        $image->save($fullPath);
    }

    /**
     * Validate the uploaded image type.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @throws \Exception
     */
    private function validateImageType($file)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            throw new \Exception('Unsupported image type. Allowed types are: JPEG, PNG, GIF, and webP.');
        }
    }
}
