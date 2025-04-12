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
        if (!$value) {
            return null;
        }
        return getImageUrl('aboutus', $value);
    }

    public function getImageUrlAttribute(){
        return $this->image ? getImageUrl('aboutus', $this->image) : null;
    }
}
