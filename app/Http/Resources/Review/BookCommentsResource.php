<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class BookCommentsResource extends JsonResource
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
            'comment'=>$this->comment,
            'rating'=>$this->rating,
            'user'=>$this->user->name,
            'user_image'=> !empty($this->user->photo->file) ? env('APP_URL')."/images/".$this->user->photo->file : null,
            'created_at'=>$this->created_at
        ];
    }
}
