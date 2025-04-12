<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsImageModel extends Model
{
    use HasFactory;

    protected $table = "image_ads";

    protected $fillable = ['image', 'ads_image', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date'];

    // Get full URL for main image
    public function getImageUrlAttribute()
    {
        return $this->image ? getImageUrl('adds', $this->image) : null;
    }

    // Get full URL for ads image
    public function getAdsImageUrlAttribute()
    {
        return $this->ads_image ? getImageUrl('adds', $this->ads_image) : null;
    }
}
