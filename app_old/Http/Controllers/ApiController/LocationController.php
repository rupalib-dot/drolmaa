<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Http\Resources\Country as ArticalCountry;
use App\Http\Resources\State as ArticalState;
use App\Http\Resources\City as ArticalCity;
use Hash;
use DB;

class LocationController extends BaseController
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
	
	public function country_list()
	{
		try
		{
			$record_data = Country::OrderBy('country_name')->get();
            if(count($record_data) > 0)
            {
                $record_data = ArticalCountry::collection($record_data);
                return $this->sendSuccess($record_data, 'Country listed successfully');
            }
            else
            {
                return $this->sendFailed('Country not found', 200);       
            }
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function state_list($country_id)
	{
		try
		{
			$record_data = State::Where('country_id',$country_id)->OrderBy('state_name')->get();
            if(count($record_data) > 0)
            {
                $record_data = ArticalState::collection($record_data);
                return $this->sendSuccess($record_data, 'State listed successfully');
            }
            else
            {
                return $this->sendFailed('State not found', 200);       
            }
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function city_list($state_id)
	{
		try
		{
			$record_data = City::Where('state_id',$state_id)->OrderBy('city_name')->get();
            if(count($record_data) > 0)
            {
                $record_data = ArticalCity::collection($record_data);
                return $this->sendSuccess($record_data, 'City listed successfully');
            }
            else
            {
                return $this->sendFailed('City not found', 200);       
            }
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}