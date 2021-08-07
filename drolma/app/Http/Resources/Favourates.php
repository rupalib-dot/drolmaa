<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource; 
use CommonFunction;
use App\Models\Favourate;

class Favourates extends JsonResource
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
            'favourate_id'           => $this->favourate_id,  
            'product_name' 	         => $product->product_name, 
            'product_id' 	         => $product->product_id,
            'selling_price' 	     => $product->selling_price,
            'mrp' 	                 => $product->mrp ,
            'product_image'          => !empty($product_image->image_name) ? asset('public/products/'.$image->image_name) : asset('front_end/images/blogimg.jpg'), 
        ];
    }
}
