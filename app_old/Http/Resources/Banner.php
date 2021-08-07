<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;


class Banner extends JsonResource
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
            'banner_id'        => $this->banner_id, 
            'description'      => $this->description,
            'banner_image' 	   => asset('public/banners/'.$this->banner_image),
        ];
    }
}
