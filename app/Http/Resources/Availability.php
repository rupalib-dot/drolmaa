<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;
use DateTime;

class Availability extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $begin = new DateTime( date('Y-m-d') );
        $end   = new DateTime(date('Y-m-d',strtotime('+14 days',strtotime(date('Y-m-d')))));
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $avail = array();
            $date = $i->format("Y-m-d"); 
            $slots = Availability::where('date',$date)->get();
            $slotsAvail = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',$this->user_id,'status',config('constant.AVAIL_STATUS.AVAILABLE'));
            $slotsBook = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',$this->user_id,'status',config('constant.AVAIL_STATUS.BOOKED'));
            
            if(count($slots)>0){
                foreach($slots as $slotavailability){
                    $avail[] = $slotavailability->time_slot;
                }
            }
            return [ 
                'availability_id' =>$date,
                'day' => date('l',strtotime($date)),
                'available_slots'=>  $slotsAvail,
                'booked_slots'=>  $slotsBook,
                'time_slot' =>  $avail,
            ];
        }        
    }
}
