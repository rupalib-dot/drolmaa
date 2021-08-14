<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;
use App\Models\Products;
use App\Models\ProductImages;


class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $datass = array();
        $productDatas = array();

        $images = ProductImages::where('product_id',$this->product_id)->get(); 
        if(count($images)>0){
            foreach($images as $image){
                $data = array(
                    'product_image_id' => $image->product_image_id, 
                    'image_name' => !empty($image->image_name) ? asset('public/products/'.$image->image_name) : asset('front_end/images/blogimg.jpg'), 
                );
                $datass[] = $data;
            } 
        }
        $products = Products::where('category_id',$this->category_id)->where('product_id','!=',$this->product_id)->get(); 
        if(count($products)>0){
            foreach($products as $product){
                $image = CommonFunction::GetSingleField('product_images','image_name','product_id',$product->product_id);
                $pdata = array(
                    'category_id'       => $product->category_id,
                    'product_id'        => $product->product_id,
                    'product_name'      => $product->product_name,
                    'product_image_name' => !empty($image) ? asset('public/products/'.$image) : asset('front_end/images/blogimg.jpg'), 
                    'mrp'               => $product->mrp,
                    'selling_price'     => $product->selling_price,
                );
                $productDatas[] = $pdata;
            } 
        }
        return [
            'product_id'        => $this->product_id,
            'product_name'      => $this->product_name,
            'description'       => $this->description,
            'referenceses'      => $this->referenceses,
            'rating'            => $this->rating,
            'instructions'      => $this->instructions,
            'category_id'       => $this->category_id,
            'category_name'     => CommonFunction::GetSingleField('category','category_name','category_id',$this->category_id),
            'quantity'          => $this->quantity,
            'selling_price'     => $this->selling_price,
            'is_featured'       => $this->is_featured,
            'mrp'               => $this->mrp,
            'expiry_date'       => date('Y-m-d',strtotime($this->expiry_date)), 
            'images'            => $datass,
            'similar_products'  => $productDatas,
        ];
    }
}
