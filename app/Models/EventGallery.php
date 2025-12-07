<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    use HasFactory;

    protected $table = "event_galleries";

    protected $fillable = [
        'event_id',
        'image',
        'sort_order'
    ];

    /**
     * Get the event that owns the gallery image.
     */
    public function event()
    {
        return $this->belongsTo(EventsModel::class, 'event_id');
    }
}
