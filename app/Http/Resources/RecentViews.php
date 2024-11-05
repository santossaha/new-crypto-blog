<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecentViews extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

                'id'=>$this->id,
                'user_id'=>$this->user_id,
                'title'=>$this->title,
                'slug'=>$this->slug,
                'image'=>$this->image,
                'content'=>$this->content,
                'short_description'=>$this->short_description,
                'meta_keyword'=>$this->meta_keyword,
                'meta_title'=>$this->meta_title,
                'meta_description'=>$this->meta_description,
                'canonical'=>$this->canonical
        ];
    }
}
