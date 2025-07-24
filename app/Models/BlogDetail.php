<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BlogDetail extends Model
{
    use HasFactory;

    protected $table = 'blog_details';
    // protected $fillable = ['id','category_id','user_id','title','image','content'];
    // protected $visible = ['category_id','user_id','title','image','content'];
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


    // public function getImageAttribute($value){
    //     if (!$value) {
    //         return null;
    //     }
    //     // Return storage URL directly since $value already includes the blog_images path
    //     return Storage::url('public/blog_images/' . $value);
    // }

    public function getImageUrlAttribute(){
        return $this->attributes['image'] ? Storage::url('public/blog_images/' . $this->attributes['image']) : null;
    }
}
