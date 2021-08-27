<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\User;
use App\Models\Bookings;
use App\Models\Feedback;

class Workshop extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        $designation    = Designation::find($this->designation); 
        $user           = User::find($this->expert);
        return [
            'workshop_id'       => $this->workshop_id,
            'title'             => $this->title,
            'price'             => $this->price,
            'description'       => $this->description,
            'image' 	        => asset('public/workshop/'.$this->image),
            'date'              => date('d M, Y', strtotime($this->date)),
            'start_date'        => date('d M, Y', strtotime($this->start_date)),
            'time'              => date('h:i A', strtotime($this->time)),
            'created_at'        => date('d M, Y', strtotime($this->created_at)),
            'designation_id'    => $this->designation,
            'total_bookings'    => CommonFunction::workshopBookedCount($this->workshop_id),
            'designation'       => $designation->designation_title,
            'duration'       => $this->duration,
            'expert'            => $user->full_name,
            'expert_id'         => $this->expert, 
        ];
    }
}
