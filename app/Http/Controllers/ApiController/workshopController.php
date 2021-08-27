<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Bookings;
use App\Http\Resources\Booking;
use App\Models\User;
use DateTime;
use App\Models\Workshop;
use App\Http\Resources\Workshop as Workshops;
use CommonFunction;
use App\Http\Controllers\ApiController\BaseController as BaseController;

 
class workshopController extends BaseController
{
    public function __construct() 
	{
        $this->User = new User;
        $this->Bookings = new Bookings;
        //header("Content-Type: application/json");
		$valid_passwords = array ("drolmaa" => "026866326a9d1d2b23226e4e5317569f");
		$valid_users = array_keys($valid_passwords);

		$user = request()->server('PHP_AUTH_USER');
		$pass = request()->server('PHP_AUTH_PW');

		$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

		if (!$validated) {
		  header('WWW-Authenticate: Basic realm="My Realm"');
		  header('HTTP/1.0 401 Unauthorized');
		  $re = array(
		  	"status" 	=> false,
		  	"message"	=> "You're not authorized to access."
		  );
		  echo json_encode($re, JSON_PRETTY_PRINT);
		  die;
		}
		
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$userid)
    { 
        $todaydate = date('Y-m-d');
        $adminPrevWorkshops  = Workshop::OrderBy('workshop_id','desc')->where('expert',$userid)->Where(function($query) use($todaydate) { $query->where('date','<', $todaydate);})->where('created_by',1)->get(); 
        $adminUpcomingWorkshops  = Workshop::OrderBy('workshop_id','desc')->where('expert',$userid)->Where(function($query) use($todaydate) {$query->where('start_date','>',$todaydate);$query->orWhere('date','>',$todaydate); })->where('created_by',1)->get();
        $selfPrevWorkshops  = Workshop::OrderBy('workshop_id','desc')->where('expert',$userid)->Where(function($query) use($todaydate) { $query->where('date','<', $todaydate) ; })->where('created_by',2)->get();
        $selfUpcomingWorkshops  = Workshop::OrderBy('workshop_id','desc')->where('expert',$userid)->Where(function($query) use($todaydate) { $query->where('start_date','>',$todaydate); $query->orWhere('date','>',$todaydate);})->where('created_by',2)->get(); 

        $data['adminWorkshop'] = ['upcoming' => CommonFunction::workshops($adminUpcomingWorkshops,$userid), 'previous' =>CommonFunction::workshops($adminPrevWorkshops,$userid)];
        $data['selfWorkshop'] = ['upcoming' => CommonFunction::workshops($selfUpcomingWorkshops,$userid), 'previous' => CommonFunction::workshops($selfPrevWorkshops,$userid)]; 
       
        return $this->sendSuccess($data, 'Workshops listed successfully');  
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
		$validator = Validator::make($request->all(),[
			'title' 	        => 'required|min:3|max:30|unique:workshop,title',
			'price' 	        => 'required|numeric',
            'designation' 	=> 'required',
            'expert' 	    => 'required',
            'end_date' 	        => 'required',
            'start_date' 	        => 'required|before:date',
            'time' 	        => 'required',			 
            'description' 	    => 'required'	 ,
            'duration'          => 'required|numeric',
        ], [
			'title.required'        => 'Title should be required',
            'title.min'              => 'Title should be minimum of 3 characters',
            'title.max'              => 'Title should be maximum of 30 characters',
            'title.unique' 		    => 'Title already exist', 
			'price.required' 	    => 'Price should be required',
            'designation.required'  => 'Designation should be required', 
            'expert.required'       => 'Expert should be required',
            'end_date.required'         => 'Date should be required',
            'start_date.required'   => 'Start Date should be required',
            'start_date.before'         => 'Start Date must be greater than end date',
            'time.required'         => 'Time should be required',
            'description.required'  =>'Description should be required',
            'duration.required'  =>'Duration should be required'
		]);

        
        try 
        { 
            $workshop_image = "";
            if($request->hasFile('image'))
            {
                $workshop_image = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('workshop'), $workshop_image); 
            } 

            \DB::beginTransaction(); 
                $workshop = new Workshop();
                $workshop->fill($request->all()); 
                $workshop->image =  $workshop_image;                
                $workshop->start_date = date('Y-m-d',strtotime($request->start_date));
                $workshop->date = date('Y-m-d',strtotime($request->end_date)); 
                $workshop->created_by = 2;
                $workshop->save();  
            \DB::commit(); 
            $workshops = Workshop::findOrfail($workshop->workshop_id); 
            $data = new Workshops($workshops); 
            return $this->sendSuccess($data, 'workshop created successfully');  
        }
        catch (\Throwable $e) 
        {
            return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);
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
        try
		{  
            $users_list = $this->Bookings->UsersBookedWorkshop($id); 
            $data = Booking::collection($users_list);  
            return $this->sendSuccess($data, 'User booking listed successfully'); 
        }
        catch (\Throwable $e)
        {
            return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
        }
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
        $validator = Validator::make($request->all(),[
			'title' 	        => 'required|min:3|max:30|unique:workshop,title',
			'price' 	        => 'required|numeric',
            'designation' 	=> 'required',
            'expert' 	    => 'required',
            'end_date' 	        => 'required',
            'start_date' 	        => 'required|before:date',
            'time' 	        => 'required',			 
            'description' 	    => 'required'	 ,
            'duration'          => 'required|numeric',
        ], [
			'title.required'        => 'Title should be required',
            'title.min'              => 'Title should be minimum of 3 characters',
            'title.max'              => 'Title should be maximum of 30 characters',
            'title.unique' 		    => 'Title already exist', 
			'price.required' 	    => 'Price should be required',
            'designation.required'  => 'Designation should be required', 
            'expert.required'       => 'Expert should be required',
            'end_date.required'         => 'Date should be required',
            'start_date.required'   => 'Start Date should be required',
            'start_date.before'         => 'Start Date must be greater than end date',
            'time.required'         => 'Time should be required',
            'description.required'  =>'Description should be required',
            'duration.required'  =>'Duration should be required'
		]);

        
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
                'designation'   => $request->designation, 
                'expert'        => $request->expert,
                'date'          => date('Y-m-d',strtotime($request->end_date)),
                'start_date'    => date('Y-m-d',strtotime($request->start_date)),
                'time'          => $request->time, 
                'updated_at'    => date('Y-m-d H:i:s'), 
                'image'         => $workshop_image,
                'duration'   => $request->duration, 
                'description'   => $request->description,   

            ]);  
            $workshops = Workshop::findOrfail($id); 
            $data = new Workshops($workshops); 
            return $this->sendSuccess($data, 'workshop created successfully');  
        }
        catch (\Throwable $e) 
        {
            return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
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
        $workshop_data = Workshop::where('workshop_id',$id)->delete(); 
        if(!empty($workshop_data)){ 
            return $this->sendSuccess('', 'Workshop deleted successfully');
        }else{
            return $this->sendFailed('Something went wrong', 200);  
        } 
    }

    //workshop list
	public function liveWorkshops(Request $request,$userid){ 
      
        try
		{    

			$upcoming_workshop_detail  = Workshop::OrderBy('title')
			->Where(function($query) use ($request) {  
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('title','LIKE', "%".$request['keyword']."%");
					$query->orWhere('price',$request['keyword']);
				}    
			})->where('start_date','>=',date('Y-m-d'))->Where('date','>=',date('Y-m-d'))->get(); 

            $previous_workshop_detail  = Workshop::OrderBy('title')
			->Where(function($query) use ($request) {  
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('title','LIKE', "%".$request['keyword']."%");
					$query->orWhere('price',$request['keyword']);
				}  
			})
			->where('date','<',date('Y-m-d'))->get(); 
 
            $data['upcoming'] = CommonFunction::workshops($upcoming_workshop_detail,$userid);  
            $data['previous'] = CommonFunction::workshops($previous_workshop_detail,$userid);  
            return $this->sendSuccess($data, 'Workshops listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

   
}
