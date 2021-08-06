<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;


class Service extends JsonResource
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
            'services_id'       => $this->services_id, 
            'services_title'    => $this->services_title,
            'services_detail'   => $this->services_detail,
            'services_photo' 	    => asset('public/services/'.$this->services_photo),
        ];
    }
}
