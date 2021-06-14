<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use URL;
use CommonFunction;
use App\Models\ContactEnquiery;
use App\Models\UserRole;
use Session;

class AdminController extends Controller
{

    public function __construct()
    { 
        $this->User     = new User;
        $this->UserRole = new UserRole;
    }

    public function index()
    { 
        $title  = "Dashboard";
        $customers = $this->User->total_users('3');
        $experts = $this->User->total_users('2');
        $data   = compact('title','experts','customers');
        return view('admin.index', $data);
       
    }
 
    public function contact_enquiery(Request $request)
    { 
        $title  = "Contact Inquiry";
        $contact_enquiery = ContactEnquiery::paginate(15);  
        $data   = compact('title','contact_enquiery','request');
        return view('admin.contact_enquiery', $data);       
    }

    public function forgot_password(Request $request)
    {
        $title  = "Forgot Password";
        if(isset($_POST['submit'])){ 
            $error_message = 	[
                'email_address.required' 	=> 'Email address / Mobile number should be required',
            ];

            $validatedData = $request->validate([
                'email_address' 	=> 'required',
            ], $error_message);

            try
            { 
               
                $emailExist	= User::with('user_role')->where('email_address',$request['email_address'])->first(); 
                if(!empty($emailExist) && $emailExist->user_role->role_id == 1){ 
                   
                    $userpassword = CommonFunction::password_generate(8);  
                    $user = User::where('email_address',$request['email_address'])->update([ 
                        'user_password'      => md5($userpassword), 
                        'updated_at'    => date('Y-m-d H:i:s'), 
                    ]);  
                    
                    if($user){
                        //mail to new subadmin
                        $details = [
                            'name'      => $emailExist->full_name, 
                            'password'  =>  $userpassword,
                            'email'  =>  $request['email_address'],
                            'userId' 	=>  $emailExist->user_id,
                        ]; 
                        \Mail::to($request['email_address'])->send(new \App\Mail\ForgotPasswordMail($details));  
                        return redirect()->route('admin.login')->with('Success','You password has been reset successfully and sent to your email. Please check your email for new password'); 
                    } else{
                        return redirect()->route('admin.login')->with('Failed', 'Something went wrong')->withInput($request->only['email_address']);  
                    }
                }else{
                    return redirect()->route('admin.login')->with('Failed', 'Invalid Credentials')->withInput($request->only['email_address']);  
                }
            }
            catch (\Throwable $e)
            {
                \DB::rollback();
                return redirect()->route('admin.login')->with('Failed', $e->getMessage())->withInput($request->only['email_address']);  
            }
        }
        $data   = compact('title');
        return view('admin.auth.forgot-password', $data);             
    }

    public function change_password(Request $request)
    {
        
        $title  = "Change Password";
        if(isset($_POST['submit'])){   
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
        $data   = compact('title');
        return view('admin.change-password', $data);             
    }
 
    public function logout()
    {
        Session()->flush();
        return redirect('/admin/login');
    }
}
