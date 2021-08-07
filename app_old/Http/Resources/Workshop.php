<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\User;

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
            'date'              => date('d M, Y', strtotime($this->date)),
            'time'              => date('h:i A', strtotime($this->time)),
            'designation_id'    => $this->designation,
            'designation'       => $designation->designation_title,
            'expert'            => $user->full_name,
            'expert_id'         => $this->expert,
        ];
    }
}
