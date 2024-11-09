<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\BlogCategory;
class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $Category =  BlogCategory::where(['type'=>$this->type,'status'=>'Active'])->orderBy('id')->get();

        return [
                'id'=>$this->id,
                'type'=>$this->type,
                'categories'=>$Category

        ];
    }
}
