<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countries extends Model
{

    protected $table = 'countries';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'country_code');
    protected $visible = array('id','name', 'country_code');

    public function getStates()
    {
        return $this->hasMany('App\Models\States', 'country_id');
    }


}
