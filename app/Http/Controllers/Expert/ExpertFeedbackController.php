<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Feedback;
use Session;

class ExpertFeedbackController extends Controller
{

    public function __construct()
    { 
        $this->Feedback  = new Feedback;  
    }

    public function feedback_list(Request $request)
    {
        $title  = "Feedbacks";
        $feedback_list   = $this->Feedback->feedback_list($request['appoinment_id'],$request['feedback_by'],$request['feedback_to'],$request['type']);
        $data   = compact('title','feedback_list','request');
        return view('expert_panel.feedback', $data);
    }

     
}
