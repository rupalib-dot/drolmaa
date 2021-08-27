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
use App\Http\Resources\HealthTip; 
use App\Http\Controllers\ApiController\BaseController as BaseController; 
use App\Models\Favourate;
use App\Http\Resources\Favourates;

class ProductController extends BaseController
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

	//products list
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

	//products list
	public function product_detail(Request $request,$product_id){ 
        try
		{   
			$products = Products::where('product_id',$product_id)->first();
            $data = new Product($products);  
            return $this->sendSuccess($data, 'Product details get successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    } 
      

	//my wishlist
	public function wishlist(Request $request,$user_id)
    { 
		try
		{    
			$Expertfavourate = Favourate::where(['user_id'=>$user_id,'module_type'=>config('constant.WISHLIST.EXPERT')])->get();  
			$productfavourate = Favourate::where(['user_id'=>$user_id,'module_type'=>config('constant.WISHLIST.PRODUCTS')])->get(); 
			if(count($Expertfavourate)>0 || count($productfavourate)>0){
				$data['ExpertWishlist'] = Favourates::collection($Expertfavourate);  
				$data['ProductWishlist'] = Favourates::collection($productfavourate); 
				return $this->sendSuccess($data, 'Wishlist listed successfully'); 
			}else{
				return $this->sendFailed('No record found', 200); 
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }
  
	//delete multiple wishlist product
    public function deleteWishlist(Request $request)
    {  
        $ids = $request['id']; 
        $delete=DB::table('favourate')->where('favourate_id',$ids)->delete();  
		if($delete){ 
		    $favdata = "";
			return $this->sendSuccess($favdata, 'Wishlist product deleted successfully');  
		}else{
			return $this->sendFailed('Wishlist product not deleted successfully', 200);   
		}  
    }
	 
 
	public function add_product_favourate(Request $request)
    { 
		$validator = Validator::make($request->all(),[
			'user_id'				=> 'required',
			'product_id'			=> 'required', 
			'module_type'			=> 'required', 
		],[
			'user_id.required' 			=> 'User Id should be required',
			'product_id.required' 		=> 'Product Id should be required', 
			'module_type.required' 		=> 'Module Type should be required', 
		]);
 
        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{  
			$exist = Favourate::where(['user_id'=>$request['user_id'],'product_id'=>$request['product_id'],'module_type'=>$request['module_type']])->first();
			
			if(!empty($exist)){
				$count_row = DB::table('favourate')->where(['user_id'=>$request['user_id'],'product_id'=>$request['product_id'],'module_type'=>$request['module_type']])->delete(); 
				
				if(!empty($count_row)){  
					$Expertfavourate = Favourate::where(['user_id'=>$request['user_id'],'module_type'=>config('constant.WISHLIST.EXPERT')])->get();  
					$productfavourate = Favourate::where(['user_id'=>$request['user_id'],'module_type'=>config('constant.WISHLIST.PRODUCTS')])->get(); 
			   
					$favdata['ExpertWishlist'] = Favourates::collection($Expertfavourate);
					 
					$favdata['ProductWishlist'] = Favourates::collection($productfavourate); 
					return $this->sendSuccess($favdata, 'Product removed from favourites successfully'); 
				}else{ 
					return $this->sendFailed('Something went wrong', 200);  
				}
			}else{
				\DB::beginTransaction(); 
					$favourate = new Favourate();
					$favourate->fill($request->all());  
					$favourate->save();   
				\DB::commit();   

				$favouratedata = Favourate::find($favourate->favourate_id);  
				$favdata = new Favourates($favouratedata);  

				return $this->sendSuccess($favdata,'Product added to favourites successfully'); 
			} 			
		}
		catch (\Throwable $e)
    	{
			\DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }


}
