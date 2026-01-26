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
            'id' => $this->getBlog->id,
            'user_id' => $this->getBlog->user_id,
            'title' => $this->getBlog->title,
            'slug' => $this->getBlog->slug,
            'image' => getFullPath('blog_images', $this->getBlog->image),
            'content' => $this->getBlog->content,
            'short_description' => $this->getBlog->short_description,
            'meta_keyword' => $this->getBlog->meta_keyword,
            'meta_title' => $this->getBlog->meta_title,
            'meta_description' => $this->getBlog->meta_description,
            'canonical' => $this->getBlog->canonical,

        ];
    }
}
