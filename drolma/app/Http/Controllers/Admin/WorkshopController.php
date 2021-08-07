<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Feedback;
use DB;
use App\Models\Workshop;
use App\Models\Bookings;

class WorkshopController extends Controller
{
    public function __construct()
    { 
        $this->Workshop     = new Workshop;
        $this->Bookings     = new Bookings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $title  = "Workshop";
        $workshop = $this->Workshop->workshop_list();  
        $data   = compact('title','workshop','request');
        return view('admin.workshop.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = "Add Workshop";
        $designation_list   = Designation::OrderBy('designation_title')->get(); 
        $data   = compact('title','designation_list');
        return view('admin.workshop.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error_message = 	[
			'title.required'        => 'Title should be required',
            'title.min'              => 'Title should be minimum of 3 characters',
            'title.max'              => 'Title should be maximum of 30 characters',
            'title.unique' 		    => 'Title already exist', 
			'price.required' 	    => 'Price should be required',
            'designation.required'  => 'Designation should be required', 
            'expert.required'       => 'Expert should be required',
            'date.required'         => 'Date should be required',
            'start_date.required'   => 'Start Date should be required',
            'start_date.before'         => 'Start Date must be greater than end date',
            'time.required'         => 'Time should be required',
		];

		$validatedData = $request->validate([
			'title' 	        => 'required|min:3|max:30|unique:workshop,title',
			'price' 	        => 'required|numeric',
            'designation' 	=> 'required',
            'expert' 	    => 'required',
            'date' 	        => 'required',
            'start_date' 	        => 'required|before:date',
            'time' 	        => 'required',			 
        ], $error_message);

        
        try 
        { 
            $workshop_data = Workshop::create([
                'title'          => $request->title,
                'price'          => $request->price, 
                'designation'   => $request->designation, 
                'expert'        => $request->expert,
                'date'          => date('Y-m-d',strtotime($request->date)),
                'start_date'    => date('Y-m-d',strtotime($request->start_date)),
                'time'          => $request->time,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]); 
            if(!empty($workshop_data)){
                return redirect()->route('workshop.index')->with('Success', 'Workshop created successfully');
            }else{
                return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
            } 
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $title  = "Workshop Detail";
        $users_list = $this->Bookings->UsersBookedWorkshop($id); 
        $feedback_list   = Feedback::where(['module_id'=>$id,'module_type'=>config('constant.FEEDBACK.BOOKING')])->orderBy('feedback_id','desc')->get();
        $data   = compact('title','users_list','request','feedback_list');
        return view('admin.workshop.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title  = "Edit Workshop";
        $workshop   = Workshop::find($id);
        $designation_list   = Designation::OrderBy('designation_title')->get(); 
        $data   = compact('title','designation_list','workshop');
        return view('admin.workshop.edit', $data);
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
        $error_message = 	[
			'title.required'        => 'Title should be required',
            'title.min'              => 'Title should be minimum of 3 characters',
            'title.max'              => 'Title should be maximum of 30 characters',
            'title.unique' 		    => 'Title already exist', 
			'price.required' 	    => 'Price should be required',
            'designation.required'  => 'Designation should be required', 
            'expert.required'       => 'Expert should be required',
            'date.required'         => 'Date should be required',
            'start_date.required'         => 'Start Date should be required',
            'start_date.before'         => 'Start Date must be greater than end date',
            'time.required'         => 'Time should be required',
		];

		$validatedData = $request->validate([
			'title' 	        => 'required|min:3|max:30|unique:workshop,title,'.$id.',workshop_id',
			'price' 	        => 'required|numeric',
            'designation' 	    => 'required',
            'expert' 	        => 'required',
            'date' 	            => 'required',
            'start_date' 	        => 'required|before:date',
            'time' 	            => 'required',			 
        ], $error_message);

        
        try 
        { 
            $workshop_data = Workshop::where('workshop_id',$id)->update([
                'title'          => $request->title,
                'price'          => $request->price, 
                'designation'   => $request->designation, 
                'expert'        => $request->expert,
                'date'          => date('Y-m-d',strtotime($request->date)),
                'start_date'    => date('Y-m-d',strtotime($request->start_date)),
                'time'          => $request->time, 
                'updated_at'    => date('Y-m-d H:i:s'),
            ]); 
            if(!empty($workshop_data)){
                return redirect()->route('workshop.index')->with('Success', 'Workshop updated successfully');
            }else{
                return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
            } 
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $workshop_data = Workshop::where('workshop_id',$id)->update([
            'deleted_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]); 
        if(!empty($workshop_data)){
            return redirect()->route('workshop.index')->with('Success', 'Workshop deleted successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }
}
