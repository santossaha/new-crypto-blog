<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogDetail extends Model
{
    protected $table = 'blog_details';
    protected $fillable = ['id','category_id','user_id','title','image','content'];
    protected $visible = ['category_id','user_id','title','image','content'];
    public $timestamps = true;
    use SoftDeletes;

    public function Comment()
    {
        return $this->hasMany(Comment::class,'blog_details_id')->withTrashed();
    }
    public function BlogCategory()
    {
        return $this->belongsTo(BlogCategory::class,'category_id')->withTrashed();
    }
    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
}
