<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
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


    public function getImageAttribute($value){
        $url = url('/');

        // Check if the URL ends with "public"
        if (substr($url, -strlen('public')) === 'public') {
            // Remove "public" from the end of the URL
            $url = substr($url, 0, -strlen('public'));
            
            // Ensure no trailing slash
            $url = rtrim($url, '/');
        }
        
        return $url.'/storage/app/public/blog_imaages/'.$value;
        // return $url.'/storage/app/public/banner/'.$value;
    
    }
}
