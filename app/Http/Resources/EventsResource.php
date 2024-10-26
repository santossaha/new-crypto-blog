<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
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
            'title'=>ucwords($this->title),
            'location'=>ucwords($this->location),
            'image'=>url('/').'/uploads/generalSetting/'.$this->image,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'meta_keyword'=>$this->meta_keyword,
            'meta_title'=>$this->meta_title,
            'meta_description'=>$this->meta_description,
            'author'=>$this->user_id,
            'canonical'=>$this->canonical
       ];
    }
}
