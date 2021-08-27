<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Appointment;
use App\Models\Feedback;
use Razorpay\Api\Api;
use Session;

class ExpertAppoinmentController extends Controller
{
    public function __construct()
    { 
        $this->Designation  = new Designation; 
        $this->Appointment  = new Appointment; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $title  = "Appointment"; 
        
       $appointment_list   = $this->Appointment->expert_appoinment_list(Session::get('user_id'),$request['from_date'],$request['payment_type'],$request['to_date'],$request['type']);
     
        $data   = compact('title','appointment_list','request');
        return view('expert_panel.appointment', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
 
    public function changeStatusAppoinment($id,$status)
    {
        $appoinment = Appointment::findOrfail($id);
        if($status == config('constant.STATUS.CANCELLED')){
            $time1 = strtotime(date('Y-m-d H:i:s'));$time2 = strtotime(date('Y-m-d H:i:s',strtotime($appoinment->date.' '.$appoinment->time))); $difference = round(($time2 - $time1) / 3600);
            if($difference >= 48){  
                $count_row = Appointment::where('appointment_id',$id)->update(['status'=>$status,'updated_at'=>date('Y-m-d H:i:s')]); 
                if(!empty($count_row)){
                    return redirect()->back()->with('Success', 'Appointment cancelled successfully');
                }else{
                    return redirect()->back()->with('Failed', 'Something went wrong');
                }
            }else{
                return redirect()->back()->with('Failed', 'You are not allowded to cancel ');
            }
        }else{
            $count_row = Appointment::where('appointment_id',$id)->update(['status'=>$status,'updated_at'=>date('Y-m-d H:i:s')]); 
            if(!empty($count_row)){
                if($status == config('constant.STATUS.REJECTED')){
                    return redirect()->back()->with('Success', 'Appointment rejected successfully');
                }else if($status == config('constant.STATUS.ACCEPTED')){
                    return redirect()->back()->with('Success', 'Appointment accepted successfully');
                }else if($status == config('constant.STATUS.COMPLETED')){
                    return redirect()->back()->with('Success', 'Appointment completed successfully');
                }else{
                    return redirect()->back()->with('Success', 'Appointment status changed successfully');
                }
            }else{
                return redirect()->back()->with('Failed', 'Something went wrong');
            }
        }
    }

    public function add_note(Request $request)
    { 
        $error_message = 	[  
            'description.required' 	=> 'Note should be required', 
            'description.min' 		=> 'Note minimum :min characters',
            'description.max' 		=> 'Note maximum :max characters', 
        ];

        $validatedData = $request->validate([ 
            'description'           => 'required|min:3|max:250',
        ], $error_message);


        $data=array(  
            'note' 	    => $request['description'], 
            'updated_at' 	    => date('Y-m-d H:i:s'), 
        );
        $count_row = Appointment::where('appointment_id',$request->appoinment_id)->update($data);  
        if(!empty($count_row)){
             return Response()->json([
                "success" => true,
                "message" => 'Note updated successfully',
            ]); 
        }else{ 
            return Response()->json([
                "success" => false,
                "message" => 'Something went wrong',
            ]);
        }
    }

    public function feedback(Request $request)
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
