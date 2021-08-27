<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Availability;
use DateTime;
use DatePeriod;
use DateInterval;
use DB;

class AvailabiltyController extends Controller
{
    public function __construct()
    { 
        $this->Availability  = new Availability;  
    }

     
    public function add_note(Request $request)
    { 
        $error_message = 	[  
            'note.required' 	=> 'Note should be required', 
            'note.min' 		=> 'Note minimum :min characters',
            'note.max' 		=> 'Note maximum :max characters', 
        ];

        $validatedData = $request->validate([ 
            'note'           => 'required|min:3|max:250',
        ], $error_message);


        $data=array(  
            'note' 	    => $request['note'], 
            'updated_at' 	    => date('Y-m-d H:i:s'), 
        );
        $count_row = Availability::where('user_id',Session::get('user_id'))->where('date',$request['availability_id'])->update($data);  
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title  = "Availability";  
        $avail_slots = Availability::where('user_id',Session::get('user_id'))->get(); 
        $data   = compact('title','avail_slots');
        return view('expert_panel.availability.availability', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = "Create Availability";   
        $data   = compact('title');
        return view('expert_panel.availability.create_availability', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
		$validatedData = $request->validate([
            'startDate' 	        => 'required|before:endDate',
            'endDate' 	            => 'required|after:startDate',
        ], [
			'startDate.required'         => 'Start Date should be required',
            'startDate.before'         => 'Start Date must be greater than end date',
            'endDate.required'         => 'Time should be required',
		]);
 
        DB::table('availability')->where('user_id',Session::get('user_id'))->delete(); 

        $begin = new DateTime(date('Y-m-d',strtotime($request['startDate'])));
        $end = new DateTime(date('Y-m-d',strtotime($request['endDate']. ' + 1 days'))); 
        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end); 
        foreach($daterange as $date){
           $datedata[] = $date->format("Y-m-d");
        } 

        
        if(isset($datedata) && count($datedata) >0){
            if(isset($request['time']) && count($request['time']) >0){ 
                foreach($datedata as $availDate){ 
                    foreach($request['time'] as $time){ 
                        $difTime = explode('_',$time); 
                        $data = array(
                            'time' => $difTime[0],
                            'time_slot' =>$difTime[1],
                            'date' => $availDate,
                            'status' => config('constant.AVAIL_STATUS.AVAILABLE'),
                            'user_id'=>Session::get('user_id'), 
                        );
                        $inserted = Availability::create($data); 
                    } 
                } 
                // echo'<pre>';print_r($getData);exit;
                if(!empty($inserted)){
                    return redirect()->route('availabilty.index')->with('Success', 'Availability created successfully');
                }else{
                    return redirect()->back()->with('Failed', 'Something went wrong');
                }
            }else{
                return redirect()->back()->with('Failed', 'Time must not be empty.');
            }
        }else{
            return redirect()->back()->with('Failed', 'Select atleast one date.');
        }
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
        $title  = "Update Availability";  
        $avail_slots = Availability::where('user_id',Session::get('user_id'))->where('date',$id)->get(); 
        $data   = compact('title','avail_slots','id');
        return view('expert_panel.availability.edit_availability', $data);
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
        DB::table('availability')->where('user_id',Session::get('user_id'))->where('date',$id)->where('status',config('constant.AVAIL_STATUS.AVAILABLE'))->delete(); 
        if(isset($request['time']) && count($request['time']) >0){  
            foreach($request['time'] as $time){ 
                $difTime = explode('_',$time); 
                $data = array(
                    'time' => $difTime[0],
                    'time_slot' =>$difTime[1],
                    'date' => date('Y-m-d',strtotime($id)),
                    'user_id'=>Session::get('user_id'), 
                    'status' => config('constant.AVAIL_STATUS.AVAILABLE'),
                );
                $inserted = Availability::create($data); 
            }  
            // echo'<pre>';print_r($getData);exit;
            if(!empty($inserted)){
                return redirect()->route('availabilty.index')->with('Success', 'Availability updated successfully');
            }else{
                return redirect()->back()->with('Failed', 'Something went wrong');
            }
        }else{
            return redirect()->back()->with('Failed', 'Time must not be empty.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('availability')->where('user_id',Session::get('user_id'))->where('date',$id)->delete(); 
        if(!empty($delete)){
            return redirect()->route('availabilty.index')->with('Success', 'Availability deleted successfully');
        }else{
            return redirect()->back()->with('Failed', 'Something went wrong');
        }
    }
}
