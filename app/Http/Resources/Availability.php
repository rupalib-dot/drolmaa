<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Availability extends JsonResource
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
            'availability_id'       => $this->availability_id,
            'time_slot'             => $this->time_slot,
        ];
    }
}
