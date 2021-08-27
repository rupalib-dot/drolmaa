<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;


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
            'user_id'           => $this->user_id,
            'full_name'         => $this->full_name,
            'mobile_number'     => $this->mobile_number,
            'email_address'     => $this->email_address,
            'user_gender'       => $this->user_gender,
            'country_id'        => $this->country_id,
            'state_id'          => $this->state_id,
            'city_id'           => $this->city_id,
            'country' 	    	=> CommonFunction::GetSingleField('country','country_name','country_id',$this->country_id),
			'state' 	        => CommonFunction::GetSingleField('state','state_name','state_id',$this->state_id),
			'city' 	        	=> CommonFunction::GetSingleField('city','city_name','city_id',$this->city_id),
            'user_dob'          => $this->user_dob,
            'user_image' 	    => !empty($this->user_image) ? asset('public/user_images/'.$this->user_image) : asset('front_end/images/blogimg.jpg'), 
        ];
    }
}
