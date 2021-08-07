<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;


class Coupon extends JsonResource
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
            'coupon_id'        => $this->coupon_id, 
            'title'            => $this->title,
            'coupon_code' 	   => $this->coupon_code,
            'discount'         => $this->discount,
            'start_date'       => date('d M, Y', strtotime($this->start_date)),
            'expiry_date'      => date('d M, Y', strtotime($this->expiry_date)), 
            'coupon_image'     => asset('public/coupon/'.$this->coupon_image),
        ];
    }	 	  
}
