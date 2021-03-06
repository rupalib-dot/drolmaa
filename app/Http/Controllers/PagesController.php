<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\ContactEnquiery;
use Session; 
use App\Models\Products;
use App\Models\Category; 
use App\Models\ProductImages;

class PagesController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function about_us(Request $request)
    { 
        $title          = "About Us";
        $data           = compact('title');
        return view('pages.aboutus', $data);
    }

    public function pricing_plan(Request $request)
    {
       $title          = "Pricing";
        $data           = compact('title');
        return view('pages.pricing', $data);
    }

    public function services(Request $request)
    { 
        $title          = "Services";
        $data           = compact('title');
        return view('pages.services', $data);
    }

    public function shop(Request $request)
    {
        $title          = "Shop";
        $category = Category::where('category_status',config('constant.BLK_UNBLK.UNBLOCK'))
        ->Where(function($query) use ($request) {
            if (isset($request['keyword']) && !empty($request['keyword'])) { 
                $query->where('category_name','LIKE', "%".$request["keyword"]."%");
            }  
        })->get();
        $products = Products::where('status',config('constant.BLK_UNBLK.UNBLOCK'))
        ->Where(function($query) use ($request) {
            if (isset($request['keyword']) && !empty($request['keyword'])) { 
                $query->where('product_name','LIKE', "%".$request["keyword"]."%");
            }  
        })->get();
        $data           = compact('title','category','products','request');
        return view('pages.shop', $data);
    }

    public function tools(Request $request)
    {
       $title          = "Tools";
        $data           = compact('title');
        return view('pages.tools', $data);
    }

    public function blog(Request $request)
    {
       $title          = "Blogs";
        $data           = compact('title');
        return view('pages.blog', $data);
    }

    public function collaboration(Request $request)
    {
       $title          = "Collaboration";
        $data           = compact('title');
        return view('pages.collaboration', $data);
    }

    
    public function shopDetail(Request $request,$id)
    {
       $title          = "Shop Detail";
       $product = Products::where('product_id',$id)->first();
        $data           = compact('title','product','id');
        return view('pages.shop_details', $data);
    }

    public function blogDetail(Request $request)
    {
       $title          = "Blog Detail";
        $data           = compact('title');
        return view('pages.blog_details', $data);
    }

     public function contact(Request $request)
    {
       $title          = "Contact";
       if(isset($_POST['submit'])){
           $error_message = 	[ 
                'name.required' 	=> 'Name should be required', 
                'name.min' 			=> 'Name minimum :min characters',
                'name.max' 			=> 'Name  maximum :max characters',
                'message.required' 	=> 'Message should be required', 
                'message.min' 		=> 'Message minimum :min characters',
                'message.max' 		=> 'Message maximum :max characters',
                'email.required' 	=> 'Email address should be required',  
                'email.max' 		=> 'Email address maximum :max characters',
                'email.regex' 		=> 'Provide valid email address',
                'phone.required' 	=> 'Phone number should be required',  
            ];

            $validatedData = $request->validate([
                'name' 	            => 'required|min:3|max:30|regex:/^[\pL\s\']+$/u',
                'message'           => 'required|min:3|max:250',
                'phone' 	        => 'required|digits:10',
                'email' 	        => 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^', 
            ], $error_message);

            $user_id = 0;
            if(Session::has('user_id')){
                $user_id = Session::get('user_id');
            }

            $data=array(
                'name' 	            => $request['name'],
                'user_id'           => $user_id,
                'message'           => $request['message'],
                'phone' 	        => $request['phone'],
                'email' 	        => $request['email'],
                'module_type' 	    => $request['module_type'],
                'module_id' 	    => $request['module_id'],
                'created_at' 	    => date('Y-m-d H:i:s'),
                'updated_at' 	    => date('Y-m-d H:i:s'), 
            );
            $count_row = ContactEnquiery::create($data);  
            if(!empty($count_row)){
                return redirect()->back()->with('Success', 'Contact inquiry submitted successfully');
            }else{
                return redirect()->back()->with('Failed', 'Something went wrong');
            }
       }
        $data           = compact('title');
        return view('pages.contact', $data);
    }
     
}
