<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Product;
use App\Models\Products;
use App\Models\Banners;
use App\Http\Resources\Banner; 
use App\Models\Services;
use App\Http\Resources\Service; 
use App\Models\Category;
use App\Http\Resources\Categorys;  
use App\Models\Expert;
use App\Http\Resources\Expert as Experts;  
use App\Models\Workshop;
use App\Http\Resources\Workshop as Workshops;  
use App\Models\Coupons;
use App\Http\Resources\Coupon; 
use App\Models\HealthTips;
use App\Http\Resources\HealthTip; 
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;

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
			$healthTips = HealthTips::get();
			$categorys = Category::Where(function($query) use ($request) { 
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('category_name','LIKE', "%".$request['keyword']."%"); 
				}  
			})->get();
			$coupons = Coupons::get();
			$products = Products::where(['is_featured'=>1,'status'=>config('constant.BLK_UNBLK.UNBLOCK')])->paginate(6);  
            $users = $this->User->user_data($user_id, $user_data); 
			$services = array();
			$banners = array();

            if($user_data->user_role->role_id == 3){
				$services = Services::where('services_for',3)->paginate(4); 
				$services = Service::collection($services); 

				$banners = Banners::get();
				$banners = Banner::collection($banners);
            }else if($user_data->user_role->role_id == 2){
				$services = Services::where('services_for',2)->get(); 
				$services = Service::collection($services); 
 
            }    
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


	public function products(Request $request){ 
        try
		{   
			$products = Products::where(['status'=>config('constant.BLK_UNBLK.UNBLOCK')])
			->Where(function($query) use ($request) { 
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('product_name','LIKE', "%".$request['keyword']."%");
					$query->orWhere('description','LIKE', "%".$request['keyword']."%");
					$query->orWhere('referenceses','LIKE', "%".$request['keyword']."%");
					$query->orWhere('instructions','LIKE', "%".$request['keyword']."%");
					$query->orWhere('quantity',$request['keyword']);
					$query->orWhere('selling_price',$request['keyword']);
					$query->orWhere('mrp',$request['keyword']);
				}  
				if (isset($request['category_id']) && !empty($request['category_id'])) { 
					$query->where('category_id',$request['category_id']); 
				}  
			})
			->get();  
            $data = Product::collection($products);  
            return $this->sendSuccess($data, 'Products listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

	public function liveWorkshops(Request $request){ 
        try
		{    
			$workshop_detail  = Workshop::OrderBy('title')
			->Where(function($query) use ($request) {  
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('title','LIKE', "%".$request['keyword']."%");
					$query->orWhere('price',$request['keyword']);
				}  
			})
			->where('date','>',date('Y-m-d'))->get(); 
            $data = Workshops::collection($workshop_detail);  
            return $this->sendSuccess($data, 'Workshops listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }
    
	public function expertList(Request $request){ 
        try
		{    
			$expert  = User::select('users.*')
			->Where(function($query) use ($request) {  
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('full_name','LIKE', "%".$request['keyword']."%");
					$query->orWhere('mobile_number',$request['keyword']);
					$query->orWhere('email_address','LIKE', "%".$request['keyword']."%");
					$query->orWhere('address_details','LIKE', "%".$request['keyword']."%");
				}  
			})
			->Where('user_role.role_id',2)
			->join('user_role','user_role.user_id','=','users.user_id')
			->orderBy('users.user_id','desc')->get();  
            $data = Experts::collection($expert);  
            return $this->sendSuccess($data, 'Expert listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

}
