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
    
    public function checkOtp(Request $request){ 
        if(isset($_POST['submit'])){
            $otp     = $request->session()->get('otp'); 
            $user_id = $request->session()->get('user_id');
            if(!empty($otp))
            {
                if($otp == $request['otp']){
                    $nRow = User::where('user_id',$user_id)->update(['email_status'=>config('constant.MAIL_STATUS.VERIFIED'),'phone_status'=>config('constant.MAIL_STATUS.VERIFIED'),'updated_at'=>date('Y-m-d H:i:s')]);
                    Session()->flush();
                    return redirect('user_login')->with('Success', 'Your Phone has been verified successfully.Please login using your email and password');
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
            $otp = $request->session()->get('otp'); 
            $msg              = 'your otp to very phone is '.$request->session()->get('otp'); 
            $data               = compact('title','msg');
            return view('verify-otp',$data);
        }
    }
}