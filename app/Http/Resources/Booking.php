<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\Workshop;
use CommonFunction;
use App\Models\User;

class Booking extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $workshop_data = CommonFunction::GetSingleRow('workshop','workshop_id',$this->module_id);
        $image = CommonFunction::GetSingleField('users','user_image','user_id',$this->user_id); 
        return [
                'booking_id'=>$this->booking_id,
                'user_id'=>$this->user_id,
                'user_name'=>CommonFunction::GetSingleField('users','full_name','user_id',$this->user_id),
                'user_image'=>!empty($image) ? asset('public/user_images/'.$image) : asset('front_end/images/blogimg.jpg'), 
                'booking_no'=>$this->booking_no,
                'status'=>array_search($this->status,config('constant.STATUS')),
                'payment_mode'=>array_search($this->payment_mode,config('constant.PAYMENT_MODE')),
                'created_at'=>date('d/m/Y', strtotime($this->created_at)),
                'payment_id'=>$this->payment_id,
                'workshop_id'=>$this->module_id,
                'title'=>$workshop_data->title, 
                'start_date'=>date('d M, Y', strtotime($workshop_data->start_date)),
                'end_date'=>date('d M, Y', strtotime($workshop_data->date)),
                'designation_id'=>$workshop_data->designation,
                'designation'=>CommonFunction::GetSingleField('designation','designation_title','designation_id',$workshop_data->designation),
                'expert_id'=>$workshop_data->expert, 
                'expert_name'=>CommonFunction::GetSingleField('users','full_name','user_id',$workshop_data->expert), 
                'expert_image'=>asset('public/user_images/'.CommonFunction::GetSingleField('users','user_image','user_id',$workshop_data->expert)), 
                'price'=>$workshop_data->price, 
                'time'=>date ('h:i A', strtotime($workshop_data->time)),
        ];
    }
}
