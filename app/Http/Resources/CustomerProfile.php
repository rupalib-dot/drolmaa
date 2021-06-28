<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerProfile extends JsonResource
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
            'full_name'         => $this->full_name,
            'mobile_number'     => $this->mobile_number,
            'email_address'     => $this->email_address,
            'user_gender'       => $this->user_gender,
            'country_id'        => $this->country_id,
            'state_id'          => $this->state_id,
            'city_id'           => $this->city_id,
            'user_dob'          => $this->user_dob,
        ];
    }
}
