<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookAudioResource extends JsonResource
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
            'url'=>env('APP_URL')."/audios/".$this->url,
            'dubauthor'=>[
                'id'=>$this->dubauthor->id,
                'name'=>$this->dubauthor->name,
            ],
        ];
    }
}
