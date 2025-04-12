<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $appends = ['file_path'];
    protected $table='sliders';
    public $timestamps=true;
    const Inactive = 'Inactive';
    const ACTIVE = 'Active';

    public function getFilePathAttribute() {
        return $this->attributes['file_path'] = $this->image ? getImageUrl('banner', $this->image) : null;
    }

    public function getImageUrlAttribute() {
        return $this->image ? getImageUrl('banner', $this->image) : null;
    }
}
