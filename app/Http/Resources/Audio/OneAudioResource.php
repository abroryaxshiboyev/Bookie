<?php

namespace App\Http\Resources\Audio;

use App\Http\Resources\Book\BookCategoryResource;
use App\Http\Resources\DubAuthor\OneDubAuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OneAudioResource extends JsonResource
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
            'name'=>$this->name,
            'url'=>$this->url,
            'book'=>new AudiBookResource($this->book),
            'dubauthor'=>new AudiDubAuthorResource($this->dubauthor),
        ];
    }
}
