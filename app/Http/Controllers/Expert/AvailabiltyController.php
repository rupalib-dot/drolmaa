<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Availability;
use DB;

class AvailabiltyController extends Controller
{
    public function __construct()
    { 
        $this->Availability  = new Availability;  
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
        DB::table('availability')->where('user_id',Session::get('user_id'))->delete(); 
        if(isset($request['available_date']) && count($request['available_date']) >0){
            if(isset($request['time']) && count($request['time']) >0){ 
                foreach($request['available_date'] as $availDate){ 
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
        //
    }
}
