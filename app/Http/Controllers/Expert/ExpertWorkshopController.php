<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Feedback;
use Session;
use CommonFunction;
use DB;
use App\Models\Workshop;
use App\Models\Availability;
use App\Models\Bookings;

class ExpertWorkshopController extends Controller
{
    public function __construct()
    { 
        $this->Workshop     = new Workshop;
        $this->Bookings     = new Bookings;
    }

    // image/about

    public function Home(){
        $title = 'Workshop Index';
        $data   = compact('title');
        return view('expert_panel.workshop.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $title  = "Workshop";
        $todaydate = date('Y-m-d');
        $Workshops  = Workshop::OrderBy('workshop_id','desc')->where('expert',Session::get('user_id'))
        ->Where(function($query) use($todaydate,$request) { 
            if($request['user'] == 'expert'){
                $query->where('created_by',2);
            }else {
                $query->where('created_by',1); 
            }
            if($request['status'] == 'previous'){
                $query->where('date','<', $todaydate);
            }else{
                $query->where('start_date','>',$todaydate);
                $query->Where('date','>',$todaydate); 
            }
           
        })
        ->paginate(10);           
        $data   = compact('title','Workshops','request');
        return view('expert_panel.workshop.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = "Add Workshop";  
        $data   = compact('title');
        return view('expert_panel.workshop.add', $data);
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
            'date.required'         => 'Date should be required',
            'start_date.required'   => 'Start Date should be required',
            'start_date.before'         => 'Start Date must be greater than end date',
            'time.required'         => 'Time should be required',
            'description.required'  =>'Description should be required'
		];

		$validatedData = $request->validate([
			'title' 	        => 'required|min:3|max:30|unique:workshop,title',
			'price' 	        => 'required|numeric', 
            'date' 	            => 'required',
            'start_date' 	    => 'required|before:date',
            'time' 	            => 'required',		
            'description' 	    => 'required'	 
        ], $error_message);

        
        try 
        { 
            $workshop_image = "";
            if($request->hasFile('image'))
            {
                $workshop_image = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('workshop'), $workshop_image); 
            } 

            $workshop_data = Workshop::create([
                'title'          => $request->title,
                'price'          => $request->price,  
                'designation'   => CommonFunction::GetSingleField('users','designation_id','user_id',Session::get('user_id')),
                'expert'        => Session::get('user_id'),
                'date'          => date('Y-m-d',strtotime($request->date)),
                'start_date'    => date('Y-m-d',strtotime($request->start_date)),
                'image'         => $workshop_image,
                'description'   => $request->description, 
                'time'          => $request->time,  
                'created_by'    => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]); 
            if(!empty($workshop_data)){
                return redirect()->route('expworkshop.index',['status'=>$request['status'],'user'=>$request['user']])->with('Success', 'Workshop created successfully');
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
        return view('expert_panel.workshop.detail', $data);
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
        $data   = compact('title','workshop');
        return view('expert_panel.workshop.edit', $data);
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
            'date.required'         => 'Date should be required',
            'start_date.required'         => 'Start Date should be required',
            'start_date.before'         => 'Start Date must be greater than end date',
            'time.required'         => 'Time should be required',
            'description.required'  =>'Description should be required'
		];

		$validatedData = $request->validate([
			'title' 	        => 'required|min:3|max:30|unique:workshop,title,'.$id.',workshop_id',
			'price' 	        => 'required|numeric', 
            'date' 	            => 'required',
            'start_date' 	        => 'required|before:date',
            'time' 	            => 'required',			 
            'description' 	    => 'required'
        ], $error_message);

        
        try 
        { 
            $workshop_image = CommonFunction::GetSingleField('workshop','image','workshop_id',$id);
            if($request->hasFile('image'))
            {
                $workshop_image = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('workshop'), $workshop_image); 
            } 

            $workshop_data = Workshop::where('workshop_id',$id)->update([
                'title'          => $request->title,
                'price'          => $request->price, 
                'description'   => $request->description, 
                'designation'   => CommonFunction::GetSingleField('users','designation_id','user_id',Session::get('user_id')),
                'expert'        => Session::get('user_id'),
                'date'          => date('Y-m-d',strtotime($request->date)),
                'start_date'    => date('Y-m-d',strtotime($request->start_date)),
                'image'         => $workshop_image,
                'time'          => $request->time, 
                'updated_at'    => date('Y-m-d H:i:s'),
            ]); 
            if(!empty($workshop_data)){
                return redirect()->route('expworkshop.index',['status'=>$request['status'],'user'=>$request['user']])->with('Success', 'Workshop updated successfully');
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
            return redirect()->route('expworkshop.index',['status'=>$request['status'],'user'=>$request['user']])->with('Success', 'Workshop deleted successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }
}
