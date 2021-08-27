<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource; 
use CommonFunction;
use App\Models\Favourate;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\Subscription;
use App\Models\Feedback;


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
        
        $datass = array();
        $productDatas = array();
        $payment_id = "";
        $month    = "";
        $plan_detail  = "";
        $register_amount  = "";
        $start_date  = "";
        $end_date    = "";
        $payment_mode = "";  
        $pname = "";
        $pid = "";
        $pselling_price = "";
        $pmrp = "";
        $pimg = "";
        $description = "";
        $preferenceses = "";
        $rating = "";
        $pinst = "";
        $pcategoryId       = "";
        $pcatname       = "";
        $pquantity     = "";
        $pisFeatured     = "";
        $pexpiryDate       = "";
        $user_id = "";
        $payment_id = "";
        $month = "";
        $plan_detail = "";
        $register_amount = "";
        $start_date = "";
        $end_date = "";
        $payment_mode = "";
        $full_name = "";
        $mobile_number = "";
        $email_address = "";
        $user_age = "";
        $user_dob = "";
        $user_gender = "";
        $country = "";
        $state = "";
        $city ="";
        $country_id = "";
        $state_id = "";
        $city_id ="";
        $address_details = "";  
        $designation_id = "";
        $designation = "";
        $office_phone_number =  "";
        $user_experience =  "";
        $description = "";
        $licance_pic =  "";
        $pan_card_pic = "";
        $aadhar_card_pic = "";
        $professional_certificate_pic = "";
        $special_plan = "";
        $user_image =  "";

        if($this->module_type == config('constant.WISHLIST.PRODUCTS')){
            $product = CommonFunction::GetSingleRow('products','product_id',$this->product_id);
            $product_image = CommonFunction::GetSingleField('product_images','image_name','product_id',$this->product_id); 

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

            $products = Products::where('category_id',$product->category_id)->where('product_id','!=',$this->product_id)->get(); 
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
            $pname = $product->product_name;
            $pid = $product->product_id;
            $pselling_price = $product->selling_price;
            $pmrp = $product->mrp;
            $pimg = !empty($product_image->image_name) ? asset('public/products/'.$image->image_name) : asset('front_end/images/blogimg.jpg');
            $description = $product->description;
            $preferenceses = $product->referenceses;
            $rating = $product->rating;
            $pinst = $product->instructions;
            $pcategoryId       = $product->category_id;
            $pcatname       = CommonFunction::GetSingleField('category','category_name','category_id',$product->category_id);
            $pquantity     = $product->quantity;
            $pisFeatured     = $product->is_featured;
            $pexpiryDate       = date('Y-m-d',strtotime($product->expiry_date)); 
 
        }
        else if($this->module_type == config('constant.WISHLIST.EXPERT')){ 
           

            $user = CommonFunction::GetSingleRow('users','user_id',$this->product_id);
            $subscription_data    = Subscription::where('user_id',$user->user_id)->orderBy('subscription_id','desc')->first();
            $feedback_count    = Feedback::where('feedback_to',$user->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->count();
            $feedback_data    = Feedback::where('feedback_to',$user->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->sum('rating');
            $rating = 0;
            if($feedback_count >0 && $feedback_data >0){
                $rating = round(($feedback_data/$feedback_count));       
            }
     
            $user_id     = $user->user_id; 
            if(!empty($subscription_data)){
                $payment_id = $subscription_data['payment_id'];
                $month    = $subscription_data['month'];
                $plan_detail  = $subscription_data['plan_detail'];
                $register_amount  = $subscription_data['register_amount'];
                $user_id     = $subscription_data['user_id'];
                $start_date  = $subscription_data['start_date'];
                $end_date    = $subscription_data['end_date']; 
                $payment_mode = array_search($subscription_data['payment_mode'],config('constant.PAYMENT_MODE'));
            } 
            $full_name = $user->full_name;
            $mobile_number = $user->mobile_number;
            $email_address = $user->email_address;
            $user_age = $user->user_age;
            $user_dob = $user->user_dob;
            $user_gender = array_search($user->user_gender,config('constant.GENDER'));
            $country = CommonFunction::GetSingleField('country','country_name','country_id',$user->country_id);
            $state = CommonFunction::GetSingleField('state','state_name','state_id',$user->state_id);
            $city = CommonFunction::GetSingleField('city','city_name','city_id',$user->city_id);
            $country_id = $user->country_id;
            $state_id = $user->state_id;
            $city_id = $user->city_id;
            $address_details = $user->address_details;  
            $designation_id = $user->designation_id;
            $designation = CommonFunction::GetSingleField('designation','designation_title','designation_id',$user->designation_id);
            $office_phone_number =  $user->office_phone_number;
            $user_experience =  $user->user_experience;
            $description =  $user->description;
            $licance_pic =  asset('public/expert_documents/'.$user->licance_pic);
            $pan_card_pic = asset('public/expert_documents/'.$user->pan_card_pic);
            $aadhar_card_pic = asset('public/expert_documents/'.$user->aadhar_card_pic);
            $professional_certificate_pic = asset('public/expert_documents/'.$user->professional_certificate_pic);
            $special_plan = $user->special_plan;
            $user_image =  asset('public/user_images/'.$user->user_image);
        }  
        return [  
            'favourate_id'          => $this->favourate_id,  
            'module_type'          => $this->module_type, 
            'module_type_name'     => array_search($this->module_type,config('constant.WISHLIST')),  
            'product_name' 	        => $pname, 
            'product_id' 	        => $pid,
            'selling_price' 	    => $pselling_price,
            'mrp' 	                =>  $pmrp,
            'product_image'         => $pimg, 
            'description'           => $description,
            'referenceses'          =>$preferenceses,
            'rating'                =>$rating,
            'instructions'          =>$pinst,
            'category_id'           => $pcategoryId,
            'category_name'         => $pcatname,
            'quantity'              => $pquantity, 
            'is_featured'           => $pisFeatured, 
            'expiry_date'           => $pexpiryDate, 
            'images'               => $datass,
            'similar_products'      => $productDatas, 
            'full_name' 	                => $full_name,
            'mobile_number' 	            => $mobile_number,
            'email_address' 				=> $email_address,
            'user_age' 	        		=> $user_age,
            'user_dob'                    => $user_dob,
            'user_gender' 	    		=> $user_gender,
            'country' 	    			=> $country,
            'state' 	        			=> $state,
            'city' 	        			=> $city,
            'country_id' 	    			=> $country_id,
            'state_id' 	        		=> $state_id,
            'city_id' 	        		=> $city_id,
            'address_details' 			=> $address_details,  
            'designation_id' 	    		=> $designation_id,
            'designation' 	        	=> $designation,
            'office_phone_number' 		=> $office_phone_number,
            'user_experience' 	    	=> $user_experience, 
            'licance_pic' 	            => $licance_pic,
            'pan_card_pic' 	            => $pan_card_pic,
            'aadhar_card_pic' 	        => $aadhar_card_pic,
            'professional_certificate_pic'=> $professional_certificate_pic, 
            'special_plan'                => $special_plan,
            'user_image' 	                => $user_image, 
          'payment_id'                    => $payment_id,
          'month'                         => $month,
          'plan_detail'                   => $plan_detail,
          'register_amount'               => $register_amount,
          'user_id'                       => $user_id,
          'start_date'                    => $start_date,
          'end_date'                      => $end_date,
          'payment_mode'                  => $payment_mode, 
            
        ];
    }
}
