<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;


class HealthTip extends JsonResource
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
            'health_tips_id'        => $this->health_tips_id,  
            'health_tips_title' 	=> $this->health_tips_title,
            'health_tips_desc'      => $this->health_tips_desc,
        ]; 
    }
}
