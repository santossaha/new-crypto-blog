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

                'id'=>$this->getProducts->id,
                'user_id'=>$this->getProducts->user_id,
                'title'=>$this->getProducts->title,
                'slug'=>$this->getProducts->slug,
                'image'=>$this->getProducts->image,
                'content'=>$this->getProducts->content,
                'short_description'=>$this->getProducts->short_description,
                'meta_keyword'=>$this->getProducts->meta_keyword,
                'meta_title'=>$this->getProducts->meta_title,
                'meta_description'=>$this->getProducts->meta_description,
                'canonical'=>$this->getProducts->canonical
        ];
    }
}
