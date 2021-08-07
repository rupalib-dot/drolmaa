<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductImages;
class OrderDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pro_image = ProductImages::where('product_id',$this->product_id)->first();
        return [
            'product_name'  => $this->product_name,
            'quantity'      => $this->quantity,
            'price'         => $this->price,
            'total_price'   => $this->total_price,
            'pro_image'     => !empty($this->pro_image) ? asset('products/'.$this->pro_image) : asset('front_end/images/blogimg.jpg'),
        ];
    }
}
