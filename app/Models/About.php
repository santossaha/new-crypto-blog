<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    protected $table = 'aboutus';
    public $timestamps = true;
    //use SoftDeletes;



    public function getImageAttribute($value){
        $url = url('/');

        // Check if the URL ends with "public"
        if (substr($url, -strlen('public')) === 'public') {
            // Remove "public" from the end of the URL
            $url = substr($url, 0, -strlen('public'));
            
            // Ensure no trailing slash
            $url = rtrim($url, '/');
        }
        
        return $url.'/storage/app/public/aboutus/'.$value;
        
    
    }
}
