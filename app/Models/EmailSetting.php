<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $table = 'email_setting';
    protected $fillable = [
        'sent_email',
        'sent_email_name',
        'use_smtp',
        'smtp_host',
        'smtp_user',
        'smtp_password',
        'smtp_port',
        'security_type'
    ];
    protected $visible = [
        'sent_email',
        'sent_email_name',
        'use_smtp',
        'smtp_host',
        'smtp_user',
        'smtp_password',
        'smtp_port',
        'security_type'
    ];
    public $timestamps = true;
}
