<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use URL;
use App\Models\UserRole;
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
        $data   = compact('title');
        return view('welcome', $data);
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
    
    
}
