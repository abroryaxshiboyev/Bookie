<?php

namespace App\Http\Resources\Favorite;

use App\Http\Resources\Book\BookAudioResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OneFavoriteResource extends JsonResource
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
            'id'=>$this->book->id,
            'name'=>$this->book->name,
            'author'=>[
                'id'=>$this->book->author->id,
                'name'=>$this->book->author->name,
            ],
            'title'=>$this->book->title,
            'price'=>$this->book->price,
            'categories'=>FavoriteBookCategoryResource::collection($this->book->categories),
            'image'=>!empty($this->book->photo->file) ? env('APP_URL')."/images/".$this->book->photo->file:null,
            'audios'=>!empty($this->audios->first()->url) ? [new BookAudioResource($this->audios->first())]:[],
            'rating'=>$this->book->rating,
            'baskets'=>count($this->book->basket),
            'favorite'=>count($this->book->favorite),
        ];
    }
}
