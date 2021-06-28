<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\User;
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
        $user               = User::find($this->expert);
        $designation        = Designation::find($this->designation);
        $current_time       = strtotime(date('Y-m-d H:i:s'));
        $appointment_time   = strtotime(date('Y-m-d H:i:s',strtotime($this->date.' '.$this->time))); 
        $difference = round(($appointment_time - $current_time) / 3600);
        return [
            'appoinment_no'     => $this->appoinment_no,
            'date'              => date('d M, Y', strtotime($this->date)),
            'time'              => date('h:i A',strtotime($this->time)).' - '.date("h:i A",strtotime('+1 hours',strtotime($this->time))),
            'expert'            => $user->full_name,
            'paln'              => ucwords(strtolower(array_search($this->plan,config('constant.PLAN')))),
            'designation'       => $designation->designation_title,
            'payment_mode'      => ucwords(strtolower(array_search($this->payment_mode,config('constant.PAYMENT_MODE')))),
            'amount'            => number_format($this->amount, 2, '.', ','),
            'status'            => ucwords(strtolower(array_search($this->status,config('constant.STATUS')))),
            'cancel_status'     => $difference >=48 ? 'Yes' : 'No',
            'feedback_status'   => $this->status == config('constant.STATUS.COMPLETED') ? 'Yes' : 'No',
            'feedback_data'     => new FeedbackArtical(Feedback::where('module_id',$this->appointment_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->first()),
        ];
    }
}
