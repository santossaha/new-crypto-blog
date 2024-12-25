<?php

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
