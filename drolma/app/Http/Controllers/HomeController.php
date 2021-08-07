<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use URL;
use App\Models\UserRole;
use App\Models\Settings;
use App\Models\Services;
use App\Models\Category;
use Session;

class HomeController extends Controller
{
    public function __construct()
    { 
        $this->User     = new User;
        $this->UserRole = new UserRole;
    }
    
    public function index_page()
    { 
        $title  = "Welcome";
        $services = Services::where('services_for',3)->get();
        $category = Category::paginate(6); 
        $data   = compact('title','services','category');
        return view('welcome', $data);
    }

    public function forgot_password(Request $request)
    {
        $title  = "Forgot Password";
        if(isset($_POST['submit'])){ 
            $error_message = 	[
                'email_address.required' 	=> 'Email address should be required',
            ];

            $validatedData = $request->validate([
                'email_address' 	=> 'required',
            ], $error_message);

            try
            { 
               
                $emailExist	= User::where('email_address',$request['email_address'])->first(); 
                if(!empty($emailExist)){  
                    //mail to new subadmin
                    $details = [
                        'name'         => $emailExist->full_name,
                        'mobile' 		=>  $emailExist->mobile_number,
                        'email' 		=> $emailExist->email_address,  
                        'userId'       => $emailExist->user_id,
                    ]; 
                    \Mail::to($request['email_address'])->send(new \App\Mail\ForgotPasswordMail($details));  
                    return redirect('user_login')->with('Success','Please check your email for password reset link & reset your password'); 
                
                }else{
                    return redirect()->back()->with('Failed', 'Invalid Credentials')->withInput($request->all());  
                }
            }
            catch (\Throwable $e)
            {
                \DB::rollback();
                return redirect()->back()->with('Failed', $e->getMessage())->withInput($request->all());  
            }
        }
        $data   = compact('title');
        return view('forgot-password', $data);             
    }

    public function reset_password(Request $request)
    {
        $title  = "Reset Password";
        if(isset($_POST['submit'])){ 
            $error_message = 	[
                'user_password.required' 	=> 'Password should be required',
                'confirm_password.required' => 'Confirm password should be required', 
                'user_password.min'         => 'Password minimun length :min characters',
                'user_password.max'         => 'Password maximum length :max characters',
                'user_password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
                'same'                      => 'Confirm password did not matched', 
            ];
    
            $validatedData = $request->validate([ 
                'user_password'		=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password'	=> 'required|required_with:user_password|same:user_password', 
            ], $error_message);

            try
            { 
                $email 	= base64_decode($request['email_address']);
                $userId 	= base64_decode($request['userId']); 
                $user_exist = User::where(['email_address'=>$email,'user_id'=> $userId])->first(); 
                if($user_exist)
                { 
                    $aPassArr = array("user_password"	=> md5($request->confirm_password),'updated_at'=>date('Y-m-d H:i:s'));
                    $nRow		= User::where(['email_address'=>$email,'user_id'=> $userId])->update($aPassArr); 
                    if ($nRow) { 
                        return redirect('user_login')->with('Success', "Password has been reset successfully...");
                    } else {
                        return redirect()->back()->withInput($request->all())->with('Failed', "Something went wrong...");
                    } 
                } else {
                    return redirect()->back()->withInput($request->all())->with('Failed', "User does not exist...");
                }
            }
            catch (\Throwable $e)
            {
                \DB::rollback();
                return redirect()->back()->with('Failed', $e->getMessage())->withInput($request->all());  
            }
        }
        $data   = compact('title','request');
        return view('reset-password', $data);             
    }

    public function login_index()
    {
        
        if(!Session::has('user_id') || !Session::has('role_id'))
        { 
            $title  = "Login";
            $data   = compact('title'); 
            if(url()->current() == URL::to('/').'/admin/login'){
                return view('admin.auth.login', $data);
            }else{
                return view('login', $data);
            }
        }
        else
        { 
            if(Session::get('role_id') == 1){
                return redirect('admin/dashboard/');
            }else if(Session::get('role_id') == 2){
                return redirect('expert/profile/'.Session::get('user_id').'/edit');
            }else{
                return redirect('profile/'.Session::get('user_id').'/edit');
            }
        }
    }

    public function login_account(Request $request)
    {
        $error_message = 	[
			'email_address.required' 	=> 'Email address / Mobile number should be required',
			'user_password.required' 	=> 'Password should be required',
            'user_password.min'         => 'Password minimun lenght :min characters',
            'user_password.max'         => 'Password maximum lenght :max characters',
            'user_password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
		];

        $validatedData = $request->validate([
			'email_address' 	=> 'required',
			'user_password' 	=> 'required|min:8|max:16',
            // regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
        ], $error_message);

        try
        {
            $user_exist = $this->User->login_account($request->email_address, md5($request->user_password), $user_data); 
            if($user_exist)
            { 
                if($user_data->email_status != config('constant.MAIL_STATUS.VERIFIED')){
                    return redirect()->back()->with('Failed', 'Your email has not been verified yet');
                }else if($user_data->phone_status != config('constant.MAIL_STATUS.VERIFIED')){
                    return redirect()->back()->with('Failed', 'Your phone number has not been verified yet');
                }else{
                    if(isset($request["remember_me"]) && $request['remember_me'] == 1) {
                        setcookie ("email_address",$request->email_address,time()+ 3600);
                        setcookie ("user_password",$request->user_password,time()+ 3600); 
                        setcookie ("remember_me",$request->remember_me,time()+ 3600);
                    } else {
                        setcookie("email_address","");
                        setcookie("user_password",""); 
                        setcookie ("remember_me","");
                    }
                    
                    if($request['loginFor'] == 'admin' && $user_data->user_role->role_id == 1){
                        Session::put('user_id',$user_data->user_id);
                        Session::put('role_id',$user_data->user_role->role_id);
                        Session::put('full_name',$user_data->full_name); 
                        return redirect('admin/dashboard/');
                    }else if($request['loginFor'] == 'admin' && $user_data->user_role->role_id != 1){
                        return redirect()->back()->with('Failed', 'You are not allowded to access admin panel');
                    }else{
                        Session::put('user_id',$user_data->user_id);
                        Session::put('role_id',$user_data->user_role->role_id);
                        Session::put('full_name',$user_data->full_name); 
                        if($user_data->user_role->role_id == 1){
                            return redirect('admin/dashboard/');
                        }else if($user_data->user_role->role_id == 2){
                            return redirect('expert/profile/'.Session::get('user_id').'/edit');
                        }else{
                            return redirect('profile/'.Session::get('user_id').'/edit');
                        }
                    }
                }
            }
            else
            {
                return redirect()->back()->with('Failed', 'Invalid login deatails');
            } 

        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
    		return redirect()->route('login')->with('Failed', $e->getMessage())->withInput($request->only['email_address']);  
    	}
    }

    public function login_logout()
    {
        Session()->flush();
        return redirect('/');
    }

    public function change_password(Request $request)
    {
        $error_message = 	[
            'CurrentPass.required' 	  => 'Current Password should be required',
            'CurrentPass.min'         => 'Current Password minimun lenght :min characters',
            'CurrentPass.max'         => 'Current Password maximum lenght :max characters', 
            'NewPass.required' 	  => 'New Password should be required',
            'NewPass.min'         => 'New Password minimun lenght :min characters',
            'NewPass.max'         => 'New Password maximum lenght :max characters',
            'NewPass.regex'       => 'New Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'ConfirmPass.required' 	=> 'Confirm Password should be required',                 
        ];

        $validatedData = $request->validate([
            'CurrentPass'	=> 'required|min:8|max:16',
            'NewPass'		=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'ConfirmPass'	=> 'required|required_with:NewPass|same:NewPass',
        ], $error_message);

        try
        {   
            
            $user_exist = $this->User->pass_exist(Session::get('user_id') ,md5($request->CurrentPass), $user_data); 
            if($user_exist)
            {
                if($request->NewPass == $request->ConfirmPass){
                    if($request->CurrentPass != $request->NewPass){
                        $aPassArr = array("user_password"	=> md5($request->ConfirmPass));
                        $nRow		= User::where('user_id',Session::get('user_id'))->update($aPassArr);
                        if ($nRow) { 
                            return redirect()->back()->with('Success', "Password has been changed successfully...");
                        } else {
                            return redirect()->back()->withInput($request->all())->with('Failed', "No change found in password...");
                        }
                    }
                    else{
                        return redirect()->back()->withInput($request->all())->with('Failed', "New password should be different from old password...");
                    }
                }else{
                    return redirect()->back()->withInput($request->all())->with('Failed', "New password and confirm password must be same..");
                }
            } else {
                return redirect()->back()->withInput($request->all())->with('Failed', "Current password does not match...");
            }
        }
        catch (\Throwable $e)
        {
            \DB::rollback();
            return redirect()->back()->withInput($request->all())->with('Failed', $e->getMessage());  
        }  
    }
    
     public function terms()
    { 
        $title  = "Terms & Condition";
        $record = Settings::first();
        $data   = compact('title','record');
        return view('terms', $data);
    }
     public function privacy()
    { 
        $title  = "Privacy & Policy";
        $record = Settings::first();
        $data   = compact('title','record');
        return view('privacy', $data);
    } 
    
}
