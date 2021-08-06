<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Subscription;
use App\Models\Feedback;
use CommonFunction;

class Expert extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        $subscription_data    = Subscription::where('user_id',$this->user_id)->orderBy('subscription_id','desc')->first();
        $feedback_count    = Feedback::where('feedback_to',$this->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->count();
        $feedback_data    = Feedback::where('feedback_to',$this->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->sum('rating');
        $rating = 0;
        if($feedback_count >0 && $feedback_data >0){
            $rating = round(($feedback_data/$feedback_count));       
        }

        $payment_id = "";
        $month    = "";
        $plan_detail  = "";
        $register_amount  = "";
        $user_id     = $this->user_id;
        $start_date  = "";
        $end_date    = "";
        $payment_mode = "";
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
        return [
              'user_id'                     => $user_id, 
              'rating'                      => $rating ,
            'full_name' 	                => $this->full_name,
			'mobile_number' 	            => $this->mobile_number,
			'email_address' 				=> $this->email_address,
			'user_age' 	        			=> $this->user_age,
            'user_dob'                      => $this->user_dob,
			'user_gender' 	    			=> array_search($this->user_gender,config('constant.GENDER')),
			'country' 	    			    => CommonFunction::GetSingleField('country','country_name','country_id',$this->country_id),
			'state' 	        			=> CommonFunction::GetSingleField('state','state_name','state_id',$this->state_id),
			'city' 	        			    => CommonFunction::GetSingleField('city','city_name','city_id',$this->city_id),
            'country_id' 	    			=> $this->country_id,
			'state_id' 	        			=> $this->state_id,
			'city_id' 	        			=> $this->city_id,
			'address_details' 				=> $this->address_details,  
			'designation_id' 	    		=> $this->designation_id,
            'designation' 	        		=> CommonFunction::GetSingleField('designation','designation_title','designation_id',$this->designation_id),
			'office_phone_number' 			=> $this->office_phone_number,
			'user_experience' 	    		=> $this->user_experience,
			'licance_pic' 	                => asset('public/expert_documents/'.$this->licance_pic),
			'pan_card_pic' 	                => asset('public/expert_documents/'.$this->pan_card_pic),
			'aadhar_card_pic' 	            => asset('public/expert_documents/'.$this->aadhar_card_pic),
			'professional_certificate_pic' 	=> asset('public/expert_documents/'.$this->professional_certificate_pic), 
            'special_plan'                  => $this->special_plan,
            'user_image' 	                => asset('public/user_images/'.$this->user_image), 
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
