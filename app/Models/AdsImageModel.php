<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsImageModel extends Model
{
    use HasFactory;
    protected $fillable = ['id','requird_image', 'ads_image', 'start_date', 'end_date'];

    protected $table = "image_ads";




    public function getImageAttribute($value){
        $url = url('/');

        // Check if the URL ends with "public"
        if (substr($url, -strlen('public')) === 'public') {
            // Remove "public" from the end of the URL
            $url = substr($url, 0, -strlen('public'));

            // Ensure no trailing slash
            $url = rtrim($url, '/');
        }

        return $url.'/storage/app/public/adds/'.$value;


    }
}
