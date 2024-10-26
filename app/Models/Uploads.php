<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected $table = 'uploads';
    protected $fillable = [ 'user_id','table_name','table_id','original_name','uploaded_name','uploaded_path'];
    protected $visible = [ 'id','user_id','table_name','table_id','original_name','uploaded_name','uploaded_path'];
    public $timestamps = true;
}
