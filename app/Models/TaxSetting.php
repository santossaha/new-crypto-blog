<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxSetting extends Model
{
    protected $table = 'taxes_setting';
    protected $fillable = [ 'name','tax'];
    protected $visible = [ 'id','name','tax'];
    public $timestamps = true;
}
