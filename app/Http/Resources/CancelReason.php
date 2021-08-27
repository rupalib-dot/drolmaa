<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Designation;
use App\Models\User; 
use CommonFunction;
use App\Models\Feedback;
use App\Http\Resources\Feedback as FeedbackArtical;

class CancelReason extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        return [
            'cancel_reasons_id'             => $this->cancel_reasons_id,
            'cancel_reasons_detail'         => $this->cancel_reasons_detail, 
            'created_date'                  => date('d M, Y', strtotime($this->created_at)),
        ];
    }
}
