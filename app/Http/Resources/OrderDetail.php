<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductImages;
use CommonFunction;
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
        $product = CommonFunction::GetSingleRow('products','product_id',$this->product_id);
        $product_image = CommonFunction::GetSingleField('product_images','image_name','product_id',$this->product_id);
 
        return [
            'product_id'    => $this->product_id,
            'product_name'  => $this->product_name,
            'quantity'      => $this->quantity,
            'price'         => round($this->price,2),
            'total_price'   => $this->total_price,
            'product_image'     => !empty($product_image->image_name) ? asset('public/products/'.$image->image_name) : asset('front_end/images/blogimg.jpg'), 
        ];
    }
}
