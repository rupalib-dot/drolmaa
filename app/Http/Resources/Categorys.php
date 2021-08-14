<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;


class Categorys extends JsonResource
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
            'category_id'        => $this->category_id, 
            'category_name'      => $this->category_name,
            'category_image' 	 => asset('public/category/'.$this->category_image),
        ];
    }
}
