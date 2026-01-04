<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'title'=>ucwords($this->title),
            'slug'=>$this->slug,
            'image'=>getFullPath('blog_images',$this->image),
            'content'=>$this->content,
            'short_description'=>$this->short_description,
            //'start_date'=>$this->start_date,
            //'end_date'=>$this->end_date,
            'meta_keyword'=>$this->meta_keyword,
            'meta_title'=>$this->meta_title,
            'meta_description'=>$this->meta_description,
            'author'=>$this->user_id,
            'canonical'=>$this->canonical,
            'created_at'=> Carbon::parse($this->created_at)->format('M d, Y'),

        ];
    }
}
