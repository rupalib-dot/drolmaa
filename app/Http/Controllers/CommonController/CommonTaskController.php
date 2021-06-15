<?php

namespace App\Http\Controllers\CommonController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User;
use DB; 

class CommonTaskController extends Controller
{
    public function __construct()
    {
       
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
                    $nRow =User::where('user_id',$userId)->update(['email_status'=>config('constant.MAIL_STATUS.VERIFIED'),'phone_status'=>config('constant.MAIL_STATUS.VERIFIED'),'updated_at'=>date('Y-m-d H:i:s')]);
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
    
}