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

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'from_date',
        'to_date',
        'start_time',
        'to_time',
        'location',
        'contact_detail',
        'email',
        'website_url',
        'facebook',
        'instagram',
        'linkedin',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'canonical',
        'author',
        'status',
        'short_description'
    ];

    /**
     * Get the gallery images for the event.
     */
    public function galleries()
    {
        return $this->hasMany(EventGallery::class, 'event_id')->orderBy('sort_order', 'asc');
    }

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
