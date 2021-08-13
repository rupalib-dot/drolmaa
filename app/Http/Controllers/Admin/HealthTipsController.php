<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\HealthTips;
use App\Models\OrderDetail;

class HealthTipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record_list    = HealthTips::OrderBy('created_at','desc')->paginate(10);
        $title          = "Health Tips";
        $data           = compact('title','record_list');
        return view('admin.health_tips.health_tips_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title          = "Health Tips Create";
        $data           = compact('title');
        return view('admin.health_tips.health_tips_create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($health_tips_id)
    {
        $record_data    = HealthTips::where('health_tips_id',base64_decode($health_tips_id))->first();
        $title          = "Health Tips Edit";
        $data           = compact('title','health_tips_id','record_data');
        return view('admin.health_tips.health_tips_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $health_tips_id)
    {
        $health_tips_id = base64_decode($health_tips_id);
        $error_message = 	[
			'health_tips_desc.required' 		=> 'Health tips description should be required',
			'health_tips_title.required' 	    => 'Health tips title should be required', 
		];   
        $validatedData = $request->validate([
			'health_tips_desc' =>'required',
			'health_tips_title' =>'required|max:50',
        ], $error_message);


        if($health_tips_id == 0)
        {
            \DB::beginTransaction();
				$health_tips = new HealthTips();
				$health_tips->fill($validatedData)->save();
			\DB::commit(); 
            return redirect()->route('health_tips.index')->with('Success','Health Tips created successfully');
        }
        else
        {  
            $data = array(
                'health_tips_desc'=>$request->health_tips_desc,
                'health_tips_title'=> $request->health_tips_title,
            ); 
            $count_row  = HealthTips::where('health_tips_id',$health_tips_id)->update($data); 
            return redirect()->route('health_tips.index')->with('Success','Health Tips updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($health_tips_id)
    {
        $health_tips = HealthTips::where('health_tips_id',base64_decode($health_tips_id))->delete();
        return redirect()->route('health_tips.index')->with('Success','Health Tips deleted successfully');
    }
}