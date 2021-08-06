<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\OrderDetail;
use App\Models\Feedback;
use App\Http\Resources\OrderDetail as OrderDetailArtical;
use App\Http\Resources\Feedback as FeedbackArtical;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $country            = Country::find($this->country_id);
        $state              = State::find($this->state_id);
        $city               = City::find($this->city_id);
        $feedback_data      = new FeedbackArtical(Feedback::where('module_id',$this->order_id)->where('module_type',config('constant.FEEDBACK.ORDER'))->first());
        return [
            'order_no'          => $this->order_no,
            'order_id'          => $this->order_id,
            'full_name'         => $this->full_name,
            'user_gender'       => ucwords(strtolower(array_search($this->user_gender, config('constant.GENDER')))),
            'company_name'      => $this->company_name,
            'address1'          => $this->address1,
            'address2'          => $this->address2,
            'country_name'      => $country->country_name,
            'state_name'        => $state->state_name,
            'city_name'         => $city->city_name,
            'mobile_number'     => $this->mobile_number,
            'email_address'     => $this->email_address,
            'grand_total'       => $this->grand_total,
            'company_name'      => $this->company_name,
            'order_status'      => ucwords(strtolower(array_search($this->order_status, config('constant.STATUS')))),
            'feedback_status'   => $this->status == config('constant.STATUS.COMPLETED') || !isset($feedback_data) ? True : False,
            'feedback_data'     => $feedback_data,
            'product_data'      => OrderDetailArtical::collection(OrderDetail::where('order_id', $this->order_id)->get()),
        ];
    }
}
