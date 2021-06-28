<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Designation extends JsonResource
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
            'designation_id'       => $this->designation_id,
            'designation_title'    => $this->designation_title,
        ];
    }
}
