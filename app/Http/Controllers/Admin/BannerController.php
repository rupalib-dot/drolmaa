<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Banners;
use App\Models\Feedback;
use App\Models\OrderDetail;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record_list    = Banners::OrderBy('created_at','desc')->paginate(10);
        $title          = "Banners";
        $data           = compact('title','record_list');
        return view('admin.banners.banner_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title          = "Banner";
        $data           = compact('title');
        return view('admin.banners.banner_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($banner_id)
    {
        $record_data    = Banners::where('banner_id',base64_decode($banner_id))->first(); 
        $title          = "Edit Banner";
        $data           = compact('title','banner_id','record_data');
        return view('admin.banners.banner_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner_id = base64_decode($id);
        $error_message = 	[
			'description.required' 		    => 'Banner description should be required', 
			'banner_file.required' 	        => 'Banner image should be required',
			'mimes' 	                    => 'Image type should be jpg, jpeg, png, webp',
		];

		$rules = [
			'description' 	=> 'required', 
		];

        if($banner_id != 0)
        {
            $rules['banner_file'] = 'mimes:jpg,jpg,png,webp';
        }
        else
        {
            $rules['banner_file'] = 'required|mimes:jpg,jpg,png,webp';
        }

        $this->validate($request, $rules, $error_message);

        if(!empty($request->file('banner_file')))
        {
            $imageName = time().'_'.rand(1111,9999).'.'.$request->file('banner_file')->getClientOriginalExtension();  
            $request->file('banner_file')->move(public_path('banners'), $imageName);  
        }else{
            if($banner_id == 0)
            {
                $imageName="";
            }
            else
            {
                $image  = Banners::where('banner_id',$banner_id)->first();
                $imageName=$image->banner_image;
            }
        }

        if($banner_id == 0)
        {
            \DB::beginTransaction();
				$banner = new Banners();
				$banner->fill($request->all());
				$banner->banner_image 	= $imageName;
				$banner->save();
			\DB::commit();
            
            return redirect()->route('banners.index')->with('Success','Banner created successfully');
        }
        else
        {
            \DB::beginTransaction(); 
                $data = array(
                    'description'=> $request->description,
                    'banner_image' 	=> $imageName,
                );
                $count_row  = Banners::where('banner_id',$banner_id)->update( $data);
			\DB::commit();
            return redirect()->route('banners.index')->with('Success','Banner updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banners::where('banner_id',base64_decode($id))->delete();
        return redirect()->route('banners.index')->with('Success','Banner deleted successfully');
    }
}
