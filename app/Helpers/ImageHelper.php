<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageHelper
{
    /**
     * Upload an image to the specified directory
     *
     * @param UploadedFile $image The uploaded image file
     * @param string $directory The directory to store the image in (inside storage/app/public)
     * @param string|null $oldImage Path to old image to delete (optional)
     * @param string|null $prefix Optional prefix for the image filename
     * @return string The filename of the uploaded image
     */
    public static function uploadImage(UploadedFile $image, string $directory, ?string $oldImage = null, ?string $prefix = null): string
    {
        // Delete old image if it exists
        if ($oldImage) {
            $oldPath = self::getPathFromUrl($oldImage);
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // Generate unique filename with prefix if provided
        $prefix = $prefix ? $prefix . '_' : '';
        $filename = $prefix . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Store the image in the public disk under specified directory
        $image->storeAs('public/' . $directory, $filename);

        // Return just the filename
        return $filename;
    }

    /**
     * Delete an image
     *
     * @param string $imagePath The full path or URL of the image to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public static function deleteImage(?string $imagePath): bool
    {
        if (!$imagePath) {
            return false;
        }

        $path = self::getPathFromUrl($imagePath);

        if ($path && Storage::exists($path)) {
            return Storage::delete($path);
        }

        return false;
    }

    /**
     * Get the public URL for an image
     *
     * @param string $directory The directory inside storage/app/public
     * @param string $filename The filename of the image
     * @return string The public URL to the image
     */
    public static function getImageUrl(string $directory, string $filename): string
    {
        if (!$filename) {
            return '';
        }

        return Storage::url('public/' . $directory . '/' . $filename);
    }

    /**
     * Extract storage path from a full URL
     *
     * @param string $url The full URL
     * @return string|null The storage path or null if it couldn't be extracted
     */
    private static function getPathFromUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        // If it's already a path, return it
        if (strpos($url, 'storage/') === 0) {
            return 'public/' . substr($url, strlen('storage/'));
        }

        // If it's a full URL with domain
        $storageUrl = url('storage');
        if (strpos($url, $storageUrl) === 0) {
            $relativePath = substr($url, strlen($storageUrl) + 1);
            return 'public/' . $relativePath;
        }

        return null;
    }
}
