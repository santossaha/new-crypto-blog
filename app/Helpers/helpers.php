<?php

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function genderRandemName($length = 8){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function imageDownload($path,$imageUrl){
    // Download the image and save it to the storage (public folder)
    $imageContents = file_get_contents($imageUrl);
    $imageName = $path.'/'.genderRandemName(). '.jpg'; // Save the image with a unique name
    Storage::disk('public')->put($imageName, $imageContents); // Store the image in the public storage disk
    return $imageName;
}

/**
 * Upload an image to the specified directory
 *
 * @param UploadedFile $image The uploaded image file
 * @param string $directory The directory to store the image in (inside storage/app/public)
 * @param string|null $oldImage Path to old image to delete (optional)
 * @param string|null $prefix Optional prefix for the image filename
 * @return string The filename of the uploaded image
 */
function uploadImage(UploadedFile $image, string $directory, ?string $oldImage = null, ?string $prefix = null): string
{
    // Delete old image if it exists
    if ($oldImage) {
        deleteImage($oldImage);
    }

    // Generate unique filename with prefix if provided
    $prefix = $prefix ? $prefix . '_' : '';
    $filename = $prefix . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

    // Store the image
    $image->storeAs('public/' . $directory, $filename);

    // Return just the filename
    return $filename;
}

/**
 * Delete an image
 *
 * @param string|null $imagePath The full path or URL of the image to delete
 * @return bool True if deletion was successful, false otherwise
 */
function deleteImage(?string $imagePath): bool
{
    if (!$imagePath) {
        return false;
    }

    $path = getPathFromUrl($imagePath);

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
function getImageUrl(string $directory, string $filename): string
{
    if (!$filename) {
        return '';
    }


    return Storage::url('public/' . $directory . '/' . $filename);
}


/**
 * Get the full public URL for an image (helper for full path)
 *
 * @param string $directory The directory inside storage/app/public
 * @param string $filename The filename of the image
 * @return string The full public URL to the image
 */
function getFullPath(string $directory, string $filename): string
{
    if (!$filename) {
        return '';
    }
    return asset('storage/' . trim($directory, '/') . '/' . ltrim($filename, '/'));
}

/**
 * Extract storage path from a full URL
 *
 * @param string|null $url The full URL
 * @return string|null The storage path or null if it couldn't be extracted
 */
function getPathFromUrl(?string $url): ?string
{
    if (!$url) {
        return null;
    }

    // If it's already a path
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

function defaultDate($date){
    if($date){
       return Carbon::parse($date)->format('d-m-Y');
    }else{
        return "";
    }

}
