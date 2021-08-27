<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use CommonFunction;
use DB;
use App\Http\Resources\Availability as Availabilitys;
use DateTime;
use DatePeriod;
use DateInterval;



class AvailabilityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() 
	{
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
    public function index(Request $request, $userid)
    {  
        $avail_slots = Availability::where('user_id',$userid)->get(); 
        if(count($avail_slots)>0){  
            $availSlots =  CommonFunction::getslotsData($userid);
            return $this->sendSuccess($availSlots, 'Availability listed successfully'); 
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
    public function store(Request $request,$userid)
    {
        try 
        { 
            DB::table('availability')->where('user_id',$userid)->delete();

            $datedata= array();
            //create date format
            $begin = new DateTime(date('Y-m-d',strtotime($request['startDate'])));
            $end = new DateTime(date('Y-m-d',strtotime($request['endDate']. ' + 1 days'))); 
            $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end); 
            foreach($daterange as $date){
               $datedata[] = $date->format("Y-m-d");
            } 
           
            $timeRequest = explode(',',$request['time']);  
            if(isset($datedata) && count($datedata) >0){
                if(isset($timeRequest) && count($timeRequest) >0){ 
                    foreach($datedata as $availDate){ 
                        foreach($timeRequest as $timedata){  
                            $data = array(
                                'time' => date("H",strtotime($timedata)),
                                'time_slot' =>$timedata,
                                'date' => $availDate,
                                'status' => config('constant.AVAIL_STATUS.AVAILABLE'),
                                'user_id'=>$userid, 
                            );
                            // echo'<pre>';print_r($data);
                            $inserted = Availability::create($data);
                        } 
                    }  
                    // echo'<pre>';print_r($getData);exit;
                    if(!empty($inserted)){
                        $availSlots = CommonFunction::getslotsData($userid);
                        return $this->sendSuccess($availSlots, 'Availability created successfully');  
                    }else{
                        return $this->sendFailed('Something went wrong', 200); 
                    }
                }else{
                    return $this->sendFailed('Time must not be empty.', 200); 
                }
            }else{ 
                return $this->sendFailed('Select atleast one date.', 200);
            }
        } catch (\Throwable $e) 
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
    public function update(Request $request, $userid,$id)
    {
        try 
        { 
            DB::table('availability')->where('user_id',$userid)->where('date',$id)->where('status',config('constant.AVAIL_STATUS.AVAILABLE'))->delete();

            $timeRequest = explode(',',$request['time']);   
            if(isset($timeRequest) && count($timeRequest) >0){ 
                foreach($timeRequest as $timedata){  
                    $data = array(
                        'time' => date("H",strtotime($timedata)),
                        'time_slot' =>$timedata,
                        'date' => date('Y-m-d',strtotime($id)),
                        'status' => config('constant.AVAIL_STATUS.AVAILABLE'),
                        'user_id'=>$userid, 
                    );
                    // echo'<pre>';print_r($data);
                    $inserted = Availability::create($data);
                }  
                // echo'<pre>';print_r($getData);exit;
                if(!empty($inserted)){
                    $availSlots = CommonFunction::getslotsData($userid);
                    return $this->sendSuccess($availSlots, 'Availability Updated successfully');  
                }else{
                    return $this->sendFailed('Something went wrong', 200); 
                }
            }else{
                return $this->sendFailed('Time must not be empty.', 200); 
            } 
        } catch (\Throwable $e) 
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
    public function destroy($userid,$id)
    {
        $availability_data = DB::table('availability')->where('date',$id)->where('user_id',$userid)->delete(); 
        if(!empty($availability_data)){ 
            return $this->sendSuccess('', 'Availability deleted successfully');
        }else{
            return $this->sendFailed('Something went wrong', 200);  
        } 
    }
}
