<?php 

class CommonFunction 
{
    public static function password_generate($chars) 
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $chars);
    }
 

     //This funciton is used to pass column name in views blade files
    public static function GetSingleField($table, $select, $field, $value)
    {
        $result = \DB::table($table)->select($select)->where([$field => $value])->first();
        if (!empty($result)) {
            return $result->$select;
        } else {
            return '';
        }
    }

    public static function GetData($table,$field, $value)
    {
        $result = \DB::table($table)->where([$field => $value])->where('deleted_at',NULL)->get();
        return $result; 
    }

    //This funciton is used to get count of slots of particular date
    public static function GetDateSlotCount($table,$field, $value,$field2, $value2,$field3, $value3)
    {
        $result = \DB::table($table)->where([$field => $value,$field3 => $value3,$field2 => $value2])->count();
        return $result; 
    }
 
     //This funciton is used to get slots of particular date
     public static function GetDateSlot($table,$field, $value)
     {
         $result = \DB::table($table)->select('time_slot')->where([$field => $value])->get();
         return $result; 
     } 

      //This funciton is used to get slots of particular date
      public static function GetMultiWhereData($table,$field, $value,$field2,$value2)
      {
          $result = \DB::table($table)->where([$field => $value])->where([$field2 => $value2])->first();
          if(!empty($result)){
             return $result; 
          }else{
              return "";
          }
          
      }
 
      //This funciton is used to get count
      public static function getCount($table,$field, $value)
      {
          $result = \DB::table($table)->where([$field => $value])->count();
          if(!empty($result)){
             return $result; 
          }else{
              return "";
          }
          
      }

     //This funciton is used to get slots of particular date
     public static function GetDateSlotStatus($table,$field, $value,$field2,$value2,$field3, $value3)
     {
         $result = \DB::table($table)->select('status')->where([$field => $value, $field2 => $value2, $field3 => $value3])->first();
         if(!empty($result)){
            return $result->status; 
         }else{
             return "";
         }
         
     }

    //This funciton is used to get single row
    public static function GetSingleRow($table, $field, $value)
    {
        return \DB::table($table)->where([$field => $value])->first();
    }

    //This funciton is used to get single row
    public static function GetRow($table, $field, $value, $field1, $value1, $field2, $value2)
    {
        return \DB::table($table)->where([$field => $value])->where([$field1 => $value1])->where([$field2 => $value2])->first();
    }

     //This funciton is used to get single row
     public static function workshopBookedCount($workshop_id)
     {
         return \DB::table('bookings')->where('module_id',$workshop_id)->count();
     }
 

     public static function refundPayment($payment_id,$amount)
	{  
        $amount = ($amount*35)/100 ;
        $username = env('RAZORPAY_KEY');
        $password = env('RAZORPAY_SECRET');
        $curl = curl_init();
        curl_setopt_array($curl, array( 
            CURLOPT_URL => "https://api.razorpay.com/v1/payments/".$payment_id."/refund",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array(
                "amount"=>$amount,
                "speed"=>"optimum",
            )),
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic '. base64_encode("$username:$password")
            ),
        ));
 

		$response = curl_exec($curl);
        $err = curl_error($curl);
		curl_close($curl); 
        $data = json_decode($response);  
        if(isset($data->id)){
            $response = array(
                'id' => $data->id,
                'description' => 'Appointment has been cancelled successfully and payment is refunded successfully' ,
                'status' =>'success',
                'amount_refund'=>$data->amount,
            );
        }else{
            $response = array(
                'id' => NULL,
                'description' => $data->error->description ,
                'status' =>'error',
                'amount_refund'=>NULL,
            ); 
        }  
		 return $response;
	} 
    // {"id":"rfnd_HHJRuEJChmgEr5","entity":"refund","amount":50000,"currency":"INR","payment_id":"pay_HHJRIs7NFFaH6L","notes":[],"receipt":null,"acquirer_data":{"arn":null},"created_at":1622445149,"batch_id":null,"status":"processed","speed_processed":"normal","speed_requested":"normal"}
    // stdClass Object ( [id] => rfnd_HHIa94svtyfwsC [entity] => refund [amount] => 50000 [currency] => INR [payment_id] => pay_HHIZrYO7ZpoRBy [notes] => Array ( ) [receipt] => [acquirer_data] => stdClass Object ( [arn] => ) [created_at] => 1622442095 [batch_id] => [status] => processed [speed_processed] => normal [speed_requested] => normal )
    // {"error":{"code":"BAD_REQUEST_ERROR","description":"The payment has been fully refunded already","source":"NA","step":"NA","reason":"NA","metadata":{}}}
}
?>