<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\Workshop;
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
        $workshop       = Workshop::find($this->module_id);
        $designation    = Designation::find($workshop->designation);
        $user           = User::find($workshop->expert);
        return [
            'booking_id'       => $this->booking_id,
            'booking_no'       => $this->booking_no,
            'module_type'      => 'Workshop',
            'title'            => $workshop->title,
            'designation'      => $designation->designation_title,
            'expert'           => $user->full_name,
            'date'             => date('d M, Y', strtotime($designation->date)),
            'time'             => date('h:i A', strtotime($designation->time)),
        ];
    }
}
