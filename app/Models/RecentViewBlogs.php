<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentViewBlogs extends Model
{
    use HasFactory;


    protected $table = 'recent_view_blogs';
    public $timestamps = true;


    public function getBlog()
    {
        return $this->belongsTo(BlogDetail::class, 'blog_id');
    }
}
