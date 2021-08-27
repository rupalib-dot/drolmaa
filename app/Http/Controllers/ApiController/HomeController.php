<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Product;
use App\Models\Products;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Http\Resources\Order as Orders;
use App\Models\Banners;
use App\Http\Resources\Banner; 
use App\Models\Services;
use DateTime;
use CommonFunction;  
use App\Models\Bookings;
use App\Http\Resources\Booking;
use App\Models\Appointment; 
use App\Http\Resources\Appointment as Appointments; 
use App\Models\Availability;
use App\Http\Resources\Service; 
use App\Models\Category;
use App\Http\Resources\Categorys;  
use App\Models\Expert;
use App\Http\Resources\Expert as Experts;  
use App\Models\Feedback;
use App\Http\Resources\Feedback as Feedbacks; 
use DB;
use App\Models\Workshop;
use App\Http\Resources\Workshop as Workshops;  
use App\Models\Coupons;
use App\Http\Resources\Coupon; 
use App\Models\HealthTips;
use App\Models\ExpertPayments;
use App\Models\Subscription;
use App\Http\Resources\HealthTip; 
use App\Http\Controllers\ApiController\BaseController as BaseController; 
use App\Models\Favourate;
use App\Http\Resources\Favourates;

class HomeController extends BaseController
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

    public function dashboard(Request $request,$user_id){ 
        try
		{ 

			$services = array();
			$banners = array();

			$healthTips = HealthTips::get(); //health tip data

			//category data
			$categorys = Category::Where(function($query) use ($request) { 
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('category_name','LIKE', "%".$request['keyword']."%"); 
				}  
			})->get();

			$coupons = Coupons::get();//coupon data

			$products = Products::where(['is_featured'=>1,'status'=>config('constant.BLK_UNBLK.UNBLOCK')])->paginate(6);  //featured products data
            
			$users = $this->User->user_data($user_id, $user_data); //users data
			
            if($user_data->user_role->role_id == 3){
				//services data for customer
				$services = Services::where('services_for',3)->get(); 
				$services = Service::collection($services); 

				//banners data for customer
				$banners = Banners::get();
				$banners = Banner::collection($banners);
            }else if($user_data->user_role->role_id == 2){
				//services data for expert
				$services = Services::where('services_for',2)->get(); 
				$services = Service::collection($services);  
            }    
            
			//response
			$data['appointment_plans'] = config('constant.PLAN');
			$data['all_status'] =  config('constant.STATUS');
			$data['banners'] =  $banners;
			$data['services'] =  $services;
			$data['categorys'] = Categorys::collection($categorys);
            $data['products'] = Product::collection($products);
			$data['coupons'] = Coupon::collection($coupons);
			$data['healthTips'] = HealthTip::collection($healthTips); 

            return $this->sendSuccess($data, 'Data listed successfully'); 
			 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

	//services list
	public function services(Request $request){ 
        try
		{  
			$services = Services::where('services_for',3)
			->Where(function($query) use ($request) { 
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('services_title','LIKE', "%".$request['keyword']."%");
					$query->orWhere('services_detail','LIKE', "%".$request['keyword']."%");
				}  
			})
			->get();  
            $data = Service::collection($services);  
            return $this->sendSuccess($data, 'Services listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }
 
	//my feedback list
	public function feedbackList(Request $request,$user_id)
    { 
		try
		{     
			$feedbackToMe  = Feedback::where('feedback_to',$user_id)
			->Where(function($query) use ($request) { 
				if (isset($request['module_id']) && !empty($request['module_id'])) {  
					$query->where('module_id',$request['module_id']); 
				} 
				if (isset($request['module_type']) && !empty($request['module_type'])) {  
					$query->where('module_type',$request['module_type']);
				}  
			})->get(); 

			$feedbackByMe  = Feedback::where('feedback_by',$user_id)
			->Where(function($query) use ($request) { 
				if (isset($request['module_id']) && !empty($request['module_id'])) {  
					$query->where('module_id',$request['module_id']); 
				} 
				if (isset($request['module_type']) && !empty($request['module_type'])) {  
					$query->where('module_type',$request['module_type']);
				}  
			})
			->get();
			if(count($feedbackToMe)>0 || count($feedbackByMe)>0){
				$data = Feedbacks::collection($feedbackToMe);  
				// ['feedbackToMe']
				// $data['feedbackByMe'] = Feedbacks::collection($feedbackByMe);
				return $this->sendSuccess($data, 'Feedback listed successfully'); 
			}else{
				return $this->sendFailed('No record found', 200); 
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

	//give feedback
	public function storeFeedback(Request $request)
	{ 
		$validator = Validator::make($request->all(),[
			'feedback_by'			=> 'required',
			'feedback_to'			=> 'required',
            'rating'				=> 'required',
            'message'		        => 'required',
            'module_type'			=> 'required',
			'module_id'				=> 'required'
		],[
			'feedback_by.required' 			=> 'User Id should be required',
			'feedback_to.required' 			=> 'Expert Id should be required',
			'rating.required' 				=> 'Ratting should be required',
            'message.required'      		=> 'Message should be required',
            'module_type.required'      	=> 'Module should be required',
            'module_id.required'      		=> 'Module Id be required',
		]);
 
        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{ 
			\DB::beginTransaction();
				$feedback = new Feedback;
				$feedback->fill($request->all())->save();
			\DB::commit();
			$record_data = new Feedbacks(Feedback::find($feedback->feedback_id));
			return $this->sendSuccess($record_data, 'Feedback sent successfully');
		}
		catch (\Throwable $e)
    	{
			\DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
 
	
	public function Payment(Request $request)
    {
        $validator = Validator::make($request->all(),[
			'razorpay_payment_id'   => 'required',
            'status'                => 'required',
            'module_id'          => 'required',
            'module_type'          => 'required',
        ],[
            'razorpay_payment_id.required'   => 'Razorpay id should be required',
            'status.required'                => 'Status be required',
            'module_id.required'            => 'Module id should be required',	  
            'module_type.required'          => 'Module type should be required',
		]); 

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{ 
            if($request['status'] == 'success'){
				if($request['module_type'] == 'order'){
					$data = [
						'payment_status' => 'paid',
						'payment_id' => $request['razorpay_payment_id'],
						'payment_type' => config('constant.PAYMENT_MODE.ONLINE'),
					];
				}else{
					$data = [
						'payment_id' => $request['razorpay_payment_id'],
						'payment_mode' => config('constant.PAYMENT_MODE.ONLINE'),
					];
				}
                if($request['module_type'] == 'appointment'){
                    $updated = Appointment::where('appointment_id',$request['module_id'])->update($data);
                }
                else if($request['module_type'] == 'booking'){
					$updated = Bookings::where('booking_id',$request['module_id'])->update($data);
                }else if($request['module_type'] == 'order'){ 
					$updated = Order::where('order_id',$request['module_id'])->update($data);
                }
            }else{
                if($request['module_type'] == 'appointment'){
                    $updated = DB::table('appointment')->where('appointment_id',$request['module_id'])->delete();
                } else if($request['module_type'] == 'booking'){
					$updated = DB::table('bookings')->where('booking_id',$request['module_id'])->delete();
                }else if($request['module_type'] == 'order'){
					$updated = DB::table('order')->where('order_id',$request['module_id'])->delete();
                }
            }
            if(isset($updated) && !empty($updated)){
                if($request['module_type'] == 'appointment'){
                    $appoinment = Appointment::findOrfail($request['module_id']); 
                    $data = new Appointments($appoinment); 
                    $times = date('H',strtotime($data['time']));
                    Availability::where('user_id',$data['expert'])->where('time',$times)->update(['status'=>config('constant.AVAIL_STATUS.BOOKED')]);
                } else if($request['module_type'] == 'booking'){
					$booking = Bookings::findOrfail($request['module_id']); 
                    $data = new Booking($booking); 
                }else if($request['module_type'] == 'order'){  
					$order = Order::find($request['module_id']); 
                    $data = new Orders($order); 
                } 				
                return $this->sendSuccess(['record'=>$data,'module_type'=>$request['module_type']], 'Data Updated successfully'); 
            }else{
                return $this->sendFailed( 'Something went wrong',200); 
            } 
        }
        catch (\Throwable $e) 
        {
			return $this->sendFailed($e->getMessage(),400);
        } 
    } 

	public function transactions(Request $request,$userid)
    {     
		$bookingdata = array();
		$subdata = array();
		$appoinmentdata = array();
		$orderdata = array();

		//subscription transactions
		$subscriptions    = Subscription::where('user_id',$userid)->orderBy('subscription_id','desc')->get();
		$TotalColection = Subscription::where('user_id',$userid)->sum('register_amount'); 
		if(count( $subscriptions)>0)  {
			foreach($subscriptions as $aGetData)  {
				$subscription[] = array(
					'payment_id' => $aGetData->payment_id,
					'amount'=>number_format($aGetData->register_amount,2,'.',','),
					'start_date' => date('d M, Y',strtotime($aGetData->start_date)),
					'end_date'	=> date('d M, Y',strtotime($aGetData->end_date)),
					'month'		=> $aGetData->month,
					'plan_detail'	=> ucwords($aGetData->plan_detail),
				);
			}
			$subdata = ['subscription' => $subscription,'Total_spent'=>number_format($TotalColection,2,'.',',')];
		}


		//appointment transaction
		$users = $this->User->user_data($userid, $user_data); //users data
		if($user_data->user_role->role_id == 3){ 
			$appointments = Appointment::where('user_id',$userid)->orderBy('appointment_id','desc')->get();
			$amountspend = Appointment::where('user_id',$userid)->sum('amount');
			$amountearned = 0;
			$amountrefund = Appointment::where('user_id',$userid)->sum('amount_refund');
			$total_collection = $amountspend - $amountrefund;
			$totalPaidamount = 0;
			$amount_left = 0;
		}else if($user_data->user_role->role_id == 2){
			$appointments = Appointment::where('expert',$userid)->orderBy('appointment_id','desc')->get();
			$amountspend = 0; 
			$amountearned = Appointment::where('expert',$userid)->sum('amount');
			$amountrefund = Appointment::where('expert',$userid)->sum('amount_refund');
			$totalPaidamount = ExpertPayments::where('user_id',$userid)->sum('amount') ;
			$total_collection = $amountearned - $amountrefund;
			$amount_left = $total_collection - $totalPaidamount;

		}    
		if(count($appointments)>0){
			foreach($appointments as $aGetData){
				$appoinmentdata[] = array( 
					'appointment_id'	=>$aGetData->appointment_id,
					'appointment_no'		=> $aGetData->appoinment_no, 
					'appointment_date'	=>date('d M, Y',strtotime($aGetData->date)),
					'payment_id'=>$aGetData->payment_id,
					'amount'	=> number_format($aGetData->amount,2,'.',','),
					'refund_id'=> $aGetData->refund_id,
					'amount_refund'=> number_format($aGetData->amount_refund,2,'.',','),
				);
			}
			$appoinmentdata = ['appointment'=> $appoinmentdata,'amountrefund'=>$amountrefund,'amountspend'=>$amountspend,'amountearned'=>$amountearned,'amount_left'=>number_format($amount_left,2,'.',','),'total_collection'=>number_format($TotalColection,2,'.',','),'totalPaidAmountByAdmin' => number_format($totalPaidamount,2,'.',',')];
		}  


		//order transactions
		$orders = Order::orderBy('order_id','desc')->where('user_id',$userid)->get();
		$amountearned = Order::where('user_id',$userid)->sum('grand_total');
		$amountrefund = Order::where('user_id',$userid)->sum('refund_amount');
		$Totalspend = $amountearned -  $amountrefund ; 
		if(count($orders)>0){
			foreach($orders as $aGetData){
				$orderdata[] = array( 
					'order_id'	=>$aGetData->order_id,
					'order_no'		=> $aGetData->order_no, 
					'order_date'	=>date('d M, Y',strtotime($aGetData->created_at)),
					'payment_id'=>$aGetData->payment_id,
					'amount'	=> number_format($aGetData->grand_total,2,'.',','),
					'refund_id'=> $aGetData->refund_id,
					'refund_amount'=> number_format($aGetData->refund_amount,2,'.',','),
				);
			}
			$orderdata = ['order'=> $orderdata,'amountspend'=>$amountearned,'total_spend'=>number_format($Totalspend,2,'.',',')];
		}   


		//booking transactions
		$users = $this->User->user_data($userid, $user_data); //users data
		if($user_data->user_role->role_id == 3){ 
			$bookings      = Bookings::where('user_id',$userid)->join('workshop','workshop.workshop_id','=','bookings.module_id')->orderBy('booking_id','desc')->get();
			$amountspend = Bookings::join('workshop','workshop.workshop_id','=','bookings.module_id')->where('bookings.user_id',$userid)->sum('workshop.price');
			$amountearned =0;
		}else if($user_data->user_role->role_id == 2){
			$bookings      = Bookings::select('bookings.*','workshop.date','workshop.start_date')->join('workshop','workshop.workshop_id','=','bookings.module_id')->where('workshop.expert',$userid)->orderBy('booking_id','desc')->get();
			$amountspend =0; 
			$amountearned = Bookings::join('workshop','workshop.workshop_id','=','bookings.module_id')->where('workshop.expert',$userid)->sum('workshop.price');
		}    
		if(count($bookings)>0){
			foreach($bookings as $aGetData){
				$bookingdata[] = array( 
					'booking_id'	=>$aGetData->booking_id,
					'booking_no'		=> $aGetData->booking_no, 
					'workshop_start_date'	=>date('d M, Y',strtotime( $aGetData->start_date)),
					'workshop_end_date'	=>date('d M, Y',strtotime( $aGetData->date)), 
					'payment_id'=>$aGetData->payment_id,
					'amount'	=> number_format($aGetData->price,2,'.',','), 
				);
			}
			$bookingdata = ['booking'=> $bookingdata,'amountearned'=>number_format($amountearned,2,'.',','),'amountspend'=>number_format($amountspend,2,'.',',')];
		}
		 
		
		$data = ['bookingdata' => $bookingdata , 'subdata' => $subdata ,'appoinmentdata'=> $appoinmentdata, 'orderdata'=>$orderdata];
		return $this->sendSuccess($data, 'Data listed successfully'); 
 
    }

}
