<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Feedback;
use Session;

class FeedbackController extends Controller
{

    public function __construct()
    { 
        $this->Feedback  = new Feedback;  
    }

    public function feedback_list(Request $request)
    {
        $title  = "Feedbacks";
        $feedback_list   = $this->Feedback->feedback_list($request['module_id'],$request['feedback_by'],$request['feedback_to'],$request['module_type']);
        $data   = compact('title','feedback_list');
        return view('customer_panel.feedback', $data);
    }

    public function feedback_submit(Request $request)
    {
        $error_message = 	[ 
            'rating.required' 	=> 'Rating should be required',  
            'note.required' 	=> 'Message should be required', 
            'note.min' 		=> 'Message minimum :min characters',
            'note.max' 		=> 'Message maximum :max characters', 
        ]; 


        $validatedData = $request->validate([
            'rating' 	        => 'required',
            'note'           => 'required|min:3|max:250',
        ], $error_message);

        $user_id = 0;
        if(Session::has('user_id')){
            $user_id = Session::get('user_id');
        } 

        $data=array( 
            'feedback_by'       => $user_id,
            'feedback_to' 	    => $request['feedback_to'],
            'message'           => $request['note'], 
            'rating' 	        => $request['rating'], 
            'module_type' 	    => $request['module_type'],
            'module_id' 	    => $request['module_id'],
            'created_at' 	    => date('Y-m-d H:i:s'),
            'updated_at' 	    => date('Y-m-d H:i:s'), 
        );
        $count_row = Feedback::create($data);  
        if(!empty($count_row)){
             return Response()->json([
                "success" => true,
                "message" => 'Feedback submitted successfully',
            ]); 
        }else{ 
            return Response()->json([
                "success" => false,
                "message" => 'Something went wrong',
            ]);
        }
    }
     
}
