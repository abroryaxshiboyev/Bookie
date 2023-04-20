<?php

namespace App\Http\Resources\Discbook;

use Illuminate\Http\Resources\Json\JsonResource;

class OneDiscbookResource extends JsonResource
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
            'book'=>[
                'id'=>$this->book->id,
                'name'=>$this->book->name,
            ],
            'discount'=>[
                'id'=>$this->discount->id,
                'name'=>$this->discount->name,
            ]
        ];
    }
}
