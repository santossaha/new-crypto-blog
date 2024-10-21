<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    protected $table = 'abouts';
    public $timestamps = true;
    //use SoftDeletes;
}
