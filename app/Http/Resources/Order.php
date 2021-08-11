<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use CommonFunction;
use App\Models\OrderDetail;
use App\Models\Feedback;
use App\Http\Resources\OrderDetail as OrderDetailArtical;
use App\Http\Resources\Feedback as FeedbackArtical;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
          
        $userimage = CommonFunction::GetSingleField('users','user_image','user_id',$this->user_id);
        
        $feedback_count    = Feedback::where('module_id',$this->order_id)->where('module_type',config('constant.FEEDBACK.ORDER'))->count();
        $feedback_sum    = Feedback::where('feedback_to',$this->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->sum('rating');
        $rating = 0;
        if($feedback_count >0 && $feedback_sum >0){
            $rating = round(($feedback_sum/$feedback_count));       
        }

        $feedback_data      = new FeedbackArtical(Feedback::where('module_id',$this->order_id)->where('module_type',config('constant.FEEDBACK.ORDER'))->first());
        return [
            'order_id'              => $this->order_id,
            'order_no'              => $this->order_no, 
            'full_name'             => $this->full_name, 
            'user_name'             => CommonFunction::GetSingleField('users','full_name','user_id',$this->user_id) ,
            'user_image'            => !empty($userimage) ? asset('public/user_images/'.$userimage) : asset('front_end/images/blogimg.jpg'), 
            'company_name'          => $this->company_name,
            'address1'              => $this->address1,
            'address2'              => $this->address2, 
            'pincode'               => $this->pincode,
            'mobile_number'         => $this->mobile_number,
            'email_address'         => $this->email_address,
            'total_withDiscount'    => $this->grand_total,
            'order_image'           => asset('front_end/images/blogimg.jpg'),
            'created_at'            => date('d M, Y', strtotime($this->created_at)),
            'company_name'          => $this->company_name,
            'status'          => $this->order_status,
            'order_status'          => ucwords(strtolower(array_search($this->order_status, config('constant.STATUS')))),
            'coupon_id'             => $this->coupon_id,
            'coupon_code'           => $this->coupon_code,
            'comment'               => $this->comment,
            'discount'              => $this->discount,
            'payment_id'            => $this->payment_id,
            'payment_type'          => ucwords(strtolower(array_search($this->payment_type,config('constant.PAYMENT_MODE')))),
            'payment_status'        => $this->payment_status,
            'total_withoutDiscount' => $this->orignal_grand_total,
            'rating'                => $rating ,
            'feedback_status'       => $this->status == config('constant.STATUS.COMPLETED') || !isset($feedback_data) ? True : False,
            'feedback_data'         => $feedback_data, 
            'product_data'          => OrderDetailArtical::collection(OrderDetail::where('order_id', $this->order_id)->get()),
        ];
    }
}
