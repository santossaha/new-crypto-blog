<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Banner extends Model
{
    protected $appends = ['file_path'];
    protected $table='sliders';
    public $timestamps=true;
    const Inactive = 'Inactive';
    const ACTIVE = 'Active';

    public function getFilePathAttribute() {
        return $this->attributes['file_path'] = $this->image ? url($this->image) : null;
    }

    public function getImageAttribute($value){
        $url = url('/');

        // Check if the URL ends with "public"
        if (substr($url, -strlen('public')) === 'public') {
            // Remove "public" from the end of the URL
            $url = substr($url, 0, -strlen('public'));
            
            // Ensure no trailing slash
            $url = rtrim($url, '/');
        }
        
        return $url.'/storage/app/public/banner/'.$value;
        
    
    }
}
