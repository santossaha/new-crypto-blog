<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'id' => $this->id,
            'user_id' => $this->getBlog->user_id,
            'title' => ucwords($this->getBlog->title),
            'slug' => $this->getBlog->slug,
            'image' => getFullPath('blog_images', $this->getBlog->image),
            'content' => $this->getBlog->content,
            'short_description' => $this->getBlog->short_description,
            'view_count' => $this->getBlog->view_count,
            'meta_keyword' => $this->getBlog->meta_keyword,
            'meta_title' => $this->getBlog->meta_title,
            'meta_description' => $this->getBlog->meta_description,
            'author' => $this->getBlog->user_id,
            'canonical' => $this->getBlog->canonical,
            'created_at' => Carbon::parse($this->created_at)->format('M d, Y'),
        ];
    }
}
