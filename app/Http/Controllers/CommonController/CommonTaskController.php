<?php

namespace App\Http\Controllers\CommonController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Designation;
use App\Models\User;
use App\Models\Feedback;
use App\Http\Resources\Feedback as Feedbacks; 
use App\Models\Workshop;
use DB; 
use Session;
use App\Models\Blog;
use App\Models\Training;
use CommonFunction;
use App\Models\Availability;

class CommonTaskController extends Controller
{
    public function __construct()
    {
       
    }

    public function live_workshops(Request $request)
    { 
        $title  = "Live Webinar";
        $todaydate = date('Y-m-d');
        $blogs = Blog::orderBy('blog_id','desc')->limit(5)->get();
        $Workshops  = Workshop::OrderBy('workshop_id','desc')
        ->Where(function($query) use($todaydate,$request) {  
            if($request['status'] == 'previous'){
                $query->where('date','<', $todaydate);
            }else{
                $query->where('start_date','>',$todaydate);
                $query->orWhere('date','>',$todaydate); 
            }
            if(isset($request['keyword']) && !empty($request['keyword'])){
                $query->where('title','LIKE', "%".$request['keyword']."%");
                $query->orWhere('price','LIKE', "%".$request['keyword']."%"); 
                $query->orWhere('description','LIKE', "%".$request['keyword']."%");  
            }if(isset($request['date']) && !empty($request['date'])){
                $query->where('start_date',$request['date']);
                $query->orWhere('date',$request['date']); 
            }if(isset($request['time']) && !empty($request['time'])){
                $query->where('time',$request['time']); 
            }if(isset($request['expert']) && !empty($request['expert'])){
                $query->where('expert',$request['expert']); 
            }
        })
        ->paginate(10);     
        $expert  = User::select('users.*') 
			->join('user_role','user_role.user_id','=','users.user_id')
			->Where('user_role.role_id',2)
			->orderBy('users.user_id','desc')->get(); 
        $data   = compact('title','blogs','Workshops','expert','request');
        return view('pages.live_webinar', $data);
    }
    public function live_workshops_details(Request $request,$id)
    { 
        $title  = "Workshop Details";
        $workshop  = Workshop::where('workshop_id',$id)->first(); 
        $data   = compact('title','workshop','request');
        return view('pages.live_webinar_details', $data);
    }

    public function our_experts(Request $request)
    { 
        $title  = "Expert List";
        $designation_list = Designation::get();
        $specialPlans = config('constant.SPECIAL_PLANS');
        $experts = User::select('users.*')
        ->Where(function($query) use ($request) {  
            if (isset($request['keyword']) && !empty($request['keyword'])) { 
                $query->where('full_name','LIKE', "%".$request['keyword']."%");
                $query->orWhere('mobile_number',$request['keyword']);
                $query->orWhere('email_address','LIKE', "%".$request['keyword']."%");
                $query->orWhere('address_details','LIKE', "%".$request['keyword']."%");
            }if(isset($request['designation'])&& !empty($request['designation'])){
                $query->where('designation_id',$request['designation']);
            }if(isset($request['specialization'])&& !empty($request['specialization'])){ 
                $query->whereRaw('FIND_IN_SET('.$request['specialization'].',special_plan)');
            } 
        }) 
        ->join('user_role','user_role.user_id','=','users.user_id')
        ->Where('user_role.role_id',2)
        ->orderBy('users.user_id','desc')->paginate(5); 
        $data   = compact('title','experts','request','designation_list','specialPlans');
        return view('pages.experts', $data);
    }

    //expert detail page
	public function expert_details(Request $request,$id){ 
      
            $title  = "Expert Details";
			$availSlots = array();
			$feedback = array();
			$availability = array();
			$plansSpecial = array();
			
			$user_data = User::find($id);   

			if(!empty($user_data)){
				
				//feedback data
				$feedback    = Feedback::where('feedback_to',$id)->where('module_type','!=',config('constant.FEEDBACK.ORDER'))->get();
				$feedback_data    = Feedback::where('feedback_to',$id)->where('module_type',config('constant.FEEDBACK.ORDER'))->sum('rating');
				$rating = 0;
				if($feedback_data > 0 && count($feedback) >0){
					$feedback_count = count($feedback);
					$rating = round($feedback_data/$feedback_count);       
				} 
				// $reviews = Feedbacks::collection($feedback);  
 
				//personal data
				$specialPlans = explode(',',$user_data->special_plan); 
				if(count($specialPlans)>0){
					foreach($specialPlans as $plans){ 
						$plansSpecial[] = array_search($plans,config('constant.SPECIAL_PLANS'));
					} 
				}
				$infoPersonal = array( 'rating' => $rating , 'description'=>$user_data->description,'full_name' => $user_data->full_name, 'mobile_number' => $user_data->mobile_number,'email_address' => $user_data->email_address, 'user_age' => $user_data->user_age,'user_dob' => $user_data->user_dob, 'user_gender' => array_search($user_data->user_gender,config('constant.GENDER')),'country' => CommonFunction::GetSingleField('country','country_name','country_id',$user_data->country_id), 'state' => CommonFunction::GetSingleField('state','state_name','state_id',$user_data->state_id), 'city' => CommonFunction::GetSingleField('city','city_name','city_id',$user_data->city_id), 'address_details' => $user_data->address_details,'designation' => CommonFunction::GetSingleField('designation','designation_title','designation_id',$user_data->designation_id),'designation_id' => $user_data->designation_id, 'office_phone_number' => $user_data->office_phone_number,'user_experience' => $user_data->user_experience.' Years', 'licance_pic' => asset('public/expert_documents/'.$user_data->licance_pic), 'pan_card_pic' => asset('public/expert_documents/'.$user_data->pan_card_pic), 'aadhar_card_pic' => asset('public/expert_documents/'.$user_data->aadhar_card_pic), 'professional_certificate_pic' 	=> asset('public/expert_documents/'.$user_data->professional_certificate_pic), 'special_plan' => $plansSpecial, 'user_image' => asset('public/user_images/'.$user_data->user_image),);
				
				//availability data
				$avail_slots = Availability::where('user_id',$id)->get();
				if(count($avail_slots) >0){
                    $availSlots =  CommonFunction::getslotsData($id);
				} 
				
                $designation_list = Designation::get();
                $specialPlans = config('constant.SPECIAL_PLANS');

				//final data
				$data = compact('title','request','designation_list','specialPlans','infoPersonal','feedback','availSlots','id');
				return view('pages.experts_details', $data); 
			}else{
				return redirect()->back()->with('Failed','No record found'); 
			}
    }



    public function our_training(Request $request)
    { 
        $title  = "Training"; 
        $trainings  = Training::OrderBy('training_id','desc')->paginate(10);     
        $data   = compact('title','trainings','request');
        return view('pages.training', $data);
    } 

    public function other_activities(Request $request)
    {  
        $title  = "Other Activities";     
        $data   = compact('title','request');
        return view('pages.other_activities', $data); 
    }
    

    public function verify_account(Request $request){
        $email 	= base64_decode($request['email']);
		$userId 	= base64_decode($request['userId']); 
		
		if(!empty($email) && !empty($userId))
		{
			try
			{  
                $emailExist = User::where(['user_id'=>$userId,'email_address'=>$email])->first();
                if(!$emailExist)
                {
                    return redirect('user_login')->with('Failed', 'Unauthorized Access...');
                }
                else
                {
                    $nRow =User::where('user_id',$userId)->update(['email_status'=>config('constant.MAIL_STATUS.VERIFIED'),'updated_at'=>date('Y-m-d H:i:s')]);
                    return redirect('user_login')->with('Success', 'Your account has been verified successfully.Please login using your email and password');
                } 
			}
			catch(\Exception $e)
			{
				return redirect('user_login')->with('Failed', $e->getMessage().' on Line '.$e->getLine());
			}
		}
		else
		{
			return redirect('user_login')->with('Failed', 'Unauthorized Access...');
		}
    }
    
    public function checkOtp(Request $request){ 
        $otp     = base64_decode($request['otp']); 
        $user_id =  base64_decode($request['user_id']);
        $module     = $request['module'];
        $page = $request['page'];
        if(isset($_POST['submit'])){ 
            if($module == 'email'){ 
                $data =['email_status'=>config('constant.MAIL_STATUS.VERIFIED'),'updated_at'=>date('Y-m-d H:i:s')]; 
            }else{ 
                $data =['phone_status'=>config('constant.MAIL_STATUS.VERIFIED'),'updated_at'=>date('Y-m-d H:i:s')]; 
            } 
            if(!empty($otp))
            {
                if($otp == $request['otp_input']){
                    $nRow = User::where('user_id',$user_id)->update($data);
                    if($request['page'] == 'login'){
                        Session()->flush();
                        return redirect('user_login')->with('Success', 'Your '.$module.' has been verified successfully.Please login using your email and password');
                    }else{   
                        if(Session::has('user_id') && Session::has('role_id')){
                            if(Session::get('role_id') == 2){ 
                                return redirect('expert/profile/'.Session::get('user_id').'/edit')->with('Success', 'Your '.$module.' status has been verified successfully');
                            }else if(Session::get('role_id') == 3){ 
                                return redirect('profile/'.Session::get('user_id').'/edit')->with('Success', 'Your '.$module.' status has been verified successfully');
                            }else{
                                return redirect()->back()->with('Failed', 'Invalid details...');
                            }
                        }else{
                            return redirect('user_login')->with('Failed', 'User not logged in');
                        }  
                    }                    
                }else
                {
                    return redirect()->back()->with('Failed', 'You have entered wrong password...');
                }
            }
            else
            {
                return redirect()->back()->with('Failed', 'Otp does not exist...');
            }
        }else{ 
            $title              = "Verify Otp";  
            $msg              = 'your otp to verify '.$module .' is '.$otp; 
            $data               = compact('title','msg','user_id','module','page','otp');
            return view('verify-otp',$data);
        }
    }
    
     public function verifyProfile(Request $request)
    {
        
        try
        {   
            $user_id = base64_decode($request->user_id);
            $otp = rand(1111,9999); 
            $request->session()->put('otp',$otp);
            
            $userdata = User::where('user_id',$user_id)->first(); 
            if($request['module'] == 'email'){ 
                $details = array(
                    'name'         => $userdata->full_name,
                    'mobile' 		=> $userdata->mobile,
                    'email' 		=> $userdata->email,   
                    'user_id'       => $user_id,
                    'otp'           => $otp
                );   
                \Mail::to($userdata->email_address)->send(new \App\Mail\VerifyMail($details));
                return redirect()->back()->with('Success', 'Otp has been sent on your email to verify your email...');  
            }else{ 
                return redirect()->route('verify.otp',['module'=>'phone','page'=>'profile','user_id'=>base64_encode($user_id),'otp'=>base64_encode($otp)])->with('Success', 'Otp sent successfully..');  
            } 
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
    		return redirect()->route('customer.create')->with('Failed', $e->getMessage())->withInput();  
    	}
    }
}