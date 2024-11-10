<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $fillable = ['id','name','type','slug'];
    protected $visible = ['id','name','type','slug'];
    public $timestamps = true;
    use SoftDeletes;

    public function BlogDetail()
    {
        return $this->hasMany(BlogDetail::class,'category_id')->withTrashed();
    }
}
