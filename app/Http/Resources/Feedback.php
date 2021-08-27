<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use CommonFunction;
use App\Models\User;

class Feedback extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        if($this->module_type == config('constant.FEEDBACK.APPOINMENT')){
            $module = CommonFunction::GetSingleField('appointment','appoinment_no','appointment_id',$this->module_id);
        }else if($this->module_type == config('constant.FEEDBACK.BOOKING')){
            $module = CommonFunction::GetSingleField('bookings','booking_no','booking_id',$this->module_id);
        }else if($this->module_type == config('constant.FEEDBACK.ORDER')){
            $module = CommonFunction::GetSingleField('order','order_no','order_id',$this->module_id) ;
        }else{
            $module = "";
        }
        $byimage = CommonFunction::GetSingleField('users','user_image','user_id',$this->feedback_by);
        $toimage = CommonFunction::GetSingleField('users','user_image','user_id',$this->feedback_to);

        return [  
            'feedback_id'           => $this->feedback_id, 
            'feedback_by_id'           =>$this->feedback_by,
            'feedback_to_id'           => $this->feedback_to ,
            'feedback_by'           => CommonFunction::GetSingleField('users','full_name','user_id',$this->feedback_by) ,
            'feedback_to'           => CommonFunction::GetSingleField('users','full_name','user_id',$this->feedback_to) ,
            'feedback_by_image'     => !empty($byimage) ? asset('public/user_images/'.$byimage) : asset('front_end/images/blogimg.jpg'),
            'feedback_to_image'     => !empty($toimage) ? asset('public/user_images/'.$toimage) : asset('front_end/images/blogimg.jpg'),
            'rating' 	            => $this->rating,
            'message' 	            => $this->message,
            'module_id' 		    => $this->module_id,
            'module' 	        	=> $module,
            'module_type'           => array_search($this->module_type,config('constant.FEEDBACK')),
            'created_at'            => date('d M, Y',strtotime($this->created_at)),
        ];
    }
}
