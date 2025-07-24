<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventsModel extends Model
{
    use HasFactory;

    protected $table = "events";

    public $timestamp = true;

    // public function getImageUrlAttribute()
    // {
    //     return $this->image ? asset('uploads/generalSetting/' . $this->image) : null;
    // }

//     public function getImageAttribute($value){
//         if (!$value) {
//             return null;
//         }
//         // Return storage URL directly since $value already includes the blog_images path
//         return Storage::url('public/event/' . $value);
//     }
 }
