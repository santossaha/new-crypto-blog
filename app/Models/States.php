<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class States extends Model
{

    protected $table = 'states';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('country_id', 'name');
    protected $visible = array('id','country_id', 'name');

    public function getCountry()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id')->withTrashed();
    }


}
