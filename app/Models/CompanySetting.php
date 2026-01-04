<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $table = 'company_setting';
    protected $fillable = [
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'phone',
        'email',
        'website',
        'gst_vat_number',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'x'
    ];
    protected $visible = [
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'phone',
        'email',
        'website',
        'gst_vat_number',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'x'
    ];
    public $timestamps = true;
}
