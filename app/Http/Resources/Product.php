<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id'        => $this->product_id,
            'product_name'      => $this->product_name,
            'description'       => $this->description,
            'referenceses'      => $this->referenceses,
            'rating'            => $this->rating,
            'instructions'      => $this->instructions,
            'selling_price'     => $this->selling_price,
            'mrp'               => $this->mrp,
            'product_image'     => $this->product_image->image_name,
        ];
    }
}
