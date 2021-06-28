<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
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
        $user                   = User::find($this->feedback_to);
        return [
            'user_image'        => asset('user_images/'.$user->user_image),
            'full_name'         => $user->full_name,
            'rating'            => $this->rating,
            'message'           => $this->message,
            'feedback_on'       => ucwords(strtolower(array_search($this->module_type,config('constant.FEEDBACK')))),
            'crreated_at'       => date('d M, Y', strtotime($this->created_at)),
        ];
    }
}
