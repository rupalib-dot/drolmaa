<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Coupons;
use App\Models\OrderDetail;

class OffersCoupnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record_list    = Coupons::OrderBy('created_at','DESC')->paginate(10);
        $title          = "Coupons";
        $data           = compact('title','record_list');
        return view('admin.coupons.coupons_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title              = "Create Coupons";
        $data               = compact('title');
        return view('admin.coupons.coupons_create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($coupon_id)
    {
        $record_data        = Coupons::where('coupon_id',base64_decode($coupon_id))->first();
        $title              = "Coupons Edit";
        $data               = compact('title','record_data');
        return view('admin.coupons.coupons_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $coupon_id)
    { 
        $coupon_id = base64_decode($coupon_id);
        $error_message = 	[
			'title.required'            => 'Title should be required',
            'title.max'                 => 'Title max 50 characters',
            'coupon_code.required'      => 'Coupon code should be required',
            'coupon_code.max'           => 'Coupon code max 50 characters',
            'discount.required'         => 'Discount should be required',
            'discount.max'              => 'Discount max 50 characters',
            'start_date.required'       => 'Start Date should be required',
            'start_date.date'           => 'Start Date must be in valid date format',
            'expiry_date.required'      => 'Expiry Date should be required',
            'expiry_date.date'          => 'Expiry Date must be in valid date format', 
            'coupon_file.required'     => 'Image should be required', 
			'mimes'                     => 'Image should be jpg, jpeg, png,webp',
            'max'                       => 'Image size max 2MB',
		];

		$validatedData = $request->validate([
			'title' 	        => 'required|max:50',
			'coupon_code' 	=> 'required|max:10',
            'discount'=> 'required|max:5',
            'start_date'=> 'required|date|before:expiry_date',
            'expiry_date' => 'required|date',
        ], $error_message);

        if($coupon_id != 0)
        {
            $validatedData[] = $request->validate([
                'coupon_file' 	    => 'mimes:jpeg,jpg,png,webp|max:2048',
            ], $error_message);
        }
        else
        {
            $validatedData[] = $request->validate([
                'coupon_file' 	    => 'required|mimes:jpeg,jpg,png,webp|max:2048',
            ], $error_message);
        }

        try
		{
           

            if(!empty($request->file('coupon_file')))
            {
                $imageName = time().'_'.rand(1111,9999).'.'.$request->file('coupon_file')->getClientOriginalExtension();  
                $request->file('coupon_file')->move(public_path('coupon'), $imageName);  
            }else{
                if($coupon_id == 0)
                {
                    $imageName="";
                }
                else
                {
                    $image  = Coupons::where('coupon_id',$coupon_id)->first();
                    $imageName=$image->coupon_image;
                }
            }
 
            if($coupon_id == 0)
            {   
                \DB::beginTransaction();
                    $coupons = new Coupons();
                    $coupons->fill($validatedData);
                    $coupons->coupon_image = $imageName;
                    $coupons->save();
                \DB::commit();
                return redirect()->route('offers_coupons.index')->with('Success','Coupons created successfully');
            }
            else
            { 
                $data = array(
                    'title'=>$request->title,
                    'coupon_code'=>$request->coupon_code,
                    'discount'=>$request->discount,
                    'start_date'=>date('Y-m-d',strtotime($request->start_date)),
                    'expiry_date'=>date('Y-m-d',strtotime($request->expiry_date)),
                    'coupon_image' 	=> $imageName,
                ); 
                Coupons::where('coupon_id',$coupon_id)->update($data); 
                return redirect()->route('offers_coupons.index')->with('Success','Coupons updated successfully');
            }
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($coupon_id)
    {
        Coupons::where('coupon_id',base64_decode($coupon_id))->delete();
        return redirect()->route('offers_coupons.index')->with('Success','Coupons deleted successfully');
    }
}