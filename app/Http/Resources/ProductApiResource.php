<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'=>$this->id,
            'name' =>$this->name,
            'price'=>[
                'normal'=> $this->price,
                'compare_price'=>$this->compare_price,
            ],
            'description'=>$this->description,
            'image'=>$this->image_url,
            'category'=>[

               'name' => $this->category->name,
                'id' => $this->category->id
            ],
            'store'=>[
                'id'=>$this->store->id,
                'name'=>$this->store->name
            ],
        ];
        // return parent::toArray($request);
    }
}
