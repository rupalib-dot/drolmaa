<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\Products;
use App\Http\Resources\Product as ProductArtical;
use Hash;
use DB;

class ProductController extends BaseController
{
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
	
	public function index(Request $request)
	{
        $error_message = 	[
			'category_id.required'       => 'Category id should be required',
		];

        $validatedData = [
			'category_id' 	        => 'required',
		];

		$validator = Validator::make($request->all(), $validatedData, $error_message);
   
        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			$product_data = Products::where('category_id',$request->category_id)->OrderBy('product_name')->get();
			if(count($product_data) > 0)
			{
				$product_data = CategoryArtical::collection($product_data);
				return $this->sendSuccess($product_data, 'Product listed successfully');
			}
			else
			{
				return $this->sendFailed('Product not found',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}

	}
}