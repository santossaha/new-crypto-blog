<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_setting';
    protected $fillable = [
        'site_logo',
        'showLogo_inSign',
        'showImage_Background',
        'signIn_backgroundImage',
        'app_title','language',
        'timezone',
        'dateFormat',
        'timeFormat',
        'currency',
        'currency_symbol',
        'currency_position',
        'row_per_page'
    ];
    protected $visible = [
        'site_logo',
        'showLogo_inSign',
        'showImage_Background',
        'signIn_backgroundImage',
        'app_title','language',
        'timezone',
        'dateFormat',
        'timeFormat',
        'currency',
        'currency_symbol',
        'currency_position',
        'row_per_page'
    ];
    public $timestamps = true;
}
