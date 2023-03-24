<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Book\OneBookResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OneCategoryResource extends JsonResource
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
            'books'=>CategoryBookResource::collection($this->books),
        ];
    }
}
