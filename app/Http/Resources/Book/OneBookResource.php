<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Category\OneCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OneBookResource extends JsonResource
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
            'author'=>[
                'id'=>$this->author->id,
                'name'=>$this->author->name,
            ],
            'title'=>$this->title,
            'price'=>$this->price,
            'categories'=>BookCategoryResource::collection($this->categories),
            'image'=>!empty($this->photo->file) ? env('APP_URL')."/images/".$this->photo->file:null,
            'audios'=>!empty($this->audios->first()->url) ? [new BookAudioResource($this->audios->first())]:[],
            'rating'=>$this->rating,
            'baskets'=>count($this->basket),
            'favorite'=>count($this->favorite),
        ];
    }
}
