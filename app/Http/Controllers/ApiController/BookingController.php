<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use Illuminate\Http\Request; 
use Validator;
use App\Models\Bookings;
use App\Http\Resources\Booking;
use App\Models\User;
use DateTime;
use CommonFunction;

class BookingController extends BaseController
{
    public function __construct() 
	{
        $this->User = new User;

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
    public function index(Request $request,$user_id)
    { 
        $updata = array();
        $predata = array();
        $todaydate = date('Y-m-d');

        $upcomingdata    = Bookings::select('bookings.*','workshop.date','workshop.start_date')
        ->join('workshop','workshop.workshop_id','=','bookings.module_id') 
        ->where('user_id',$user_id) 
        ->Where(function($query) use($todaydate) {
            $query->where('start_date','>',$todaydate);
            $query->orWhere('date','>',$todaydate);       
        })
        ->orderBy('booking_id','desc')
        ->get(); 
        $previousdata    = Bookings::select('bookings.*','workshop.date','workshop.start_date')
        ->join('workshop','workshop.workshop_id','=','bookings.module_id') 
        ->where('user_id',$user_id) 
        ->where('date','<', $todaydate) 
        ->orderBy('booking_id','desc')
        ->get();  

        if(count($upcomingdata) > 0 || count($previousdata) > 0){
            $bookingData['upcomming'] = Booking::collection($upcomingdata);
            $bookingData['previous'] = Booking::collection($previousdata); 
            return $this->sendSuccess($bookingData, 'bookings listed successfully'); 
        }else{
            return $this->sendFailed('No record found', 200); 
        } 
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
            'workshop_id' 	        => 'required', 
            'user_id' 	        => 'required', 		 
        ],[
            'workshop_id.required'         => 'Workshop Id should be required', 
            'user_id.required'         => 'User Id should be required', 
		]); 

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }
  
        try 
        { 
            $bookingExist = Bookings::where('user_id',$request['user_id'])->where('module_id',$request->workshop_id)->first();
            if(empty($bookingExist)){  
                \DB::beginTransaction(); 
                    $bookings = new Bookings();
                    $bookings->fill($request->all()); 
                    $bookings->booking_no = "BOO-".rand(11111,99999);
                    $bookings->module_id = $request['workshop_id'];
                    $bookings->status = config('constant.STATUS.ACCEPTED');
                    $bookings->module_type = config('constant.BOOKING.WORKSHOP');
                    $bookings->save();  
                \DB::commit();  
                return $this->sendSuccess(['booking_id'=>$bookings->booking_id], 'Booking created successfully'); 
            }else{
                return $this->sendFailed('You have alerady booked this workshop', 200);  
            } 
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
}
