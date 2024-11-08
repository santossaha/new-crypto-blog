<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinks extends Model
{
    protected $table = 'social_links';
    protected $fillable = ['facebook','google_plus','twitter','linkedin','youtube','instagram'];
    protected $visible = ['id','facebook','google_plus','twitter','linkedin','youtube','instagram'];
    public $timestamps = true;
}
