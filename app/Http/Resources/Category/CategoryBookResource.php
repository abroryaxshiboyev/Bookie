<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryBookResource extends JsonResource
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
            'name'=>$this->name,
            'author_name'=>$this->author_name,
            'title'=>$this->title,
            'price'=>$this->price,
            'categories'=>CategoryCategoryResource::collection($this->categories),
            'image'=>$this->photo->file?? null,
            'audio'=>$this->audios->first()->url?? null,
            'rating'=>$this->rating,
            'baskets'=>count($this->basket),
            'favorite'=>count($this->favorite)
        ];
    }
}
