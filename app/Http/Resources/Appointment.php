<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\User; 
use CommonFunction;
use App\Models\Feedback;
use App\Http\Resources\Feedback as FeedbackArtical;

class Appointment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        $current_time       = strtotime(date('Y-m-d H:i:s'));
        $appointment_time   = strtotime(date('Y-m-d H:i:s',strtotime($this->date.' '.$this->time))); 
        $difference = round(($appointment_time - $current_time) / 3600);
        $feedback_data      = new FeedbackArtical(Feedback::where('module_id',$this->appointment_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->first());
       
        $byimage = CommonFunction::GetSingleField('users','user_image','user_id',$this->user_id);
        $toimage = CommonFunction::GetSingleField('users','user_image','user_id',$this->expert);

        return [
            'appoinment_id'     => $this->appointment_id,
            'created_by'        => $this->name,
            'appoinment_no'     => $this->appoinment_no,
            'date'              => date('d M, Y', strtotime($this->date)),
            'time'              => date('h:i A',strtotime($this->time)),
            'time_slot'         => date('h:i A',strtotime($this->time)).' - '.date("h:i A",strtotime('+1 hours',strtotime($this->time))),
            'user_id'           => $this->user_id,
            'expert'            => $this->expert,
            'note'              => $this->note,
            'user_name'         => CommonFunction::GetSingleField('users','full_name','user_id',$this->user_id) ,
            'expert_name'       => CommonFunction::GetSingleField('users','full_name','user_id',$this->expert) ,
            'user_image'        => !empty($byimage) ? asset('public/user_images/'.$byimage) : asset('front_end/images/blogimg.jpg'),
            'expert_image'      => !empty($toimage) ? asset('public/user_images/'.$toimage) : asset('front_end/images/blogimg.jpg'), 
            'plan'              => ucwords(strtolower(array_search($this->plan,config('constant.PLAN')))),
            'designation_id'    => $this->designation,
            'designation'       => CommonFunction::GetSingleField('designation','designation_title','designation_id',$this->designation),
            'payment_mode'      => ucwords(strtolower(array_search($this->payment_mode,config('constant.PAYMENT_MODE')))),
            'payment_id'        => $this->payment_id,
            'refund_id'         => $this->refund_id,
            'amount_refund'     => $this->amount_refund,
            'amount'            => number_format($this->amount, 2, '.', ','),
            'status'            => ucwords(strtolower(array_search($this->status,config('constant.STATUS')))),
            'cancel_status'     => $difference >=48 ? True : False,
            'feedback_status'   => $this->status == config('constant.STATUS.COMPLETED') || !isset($feedback_data) ? True : False,
            'feedback_data'     => $feedback_data, 
        ];
    }
}
