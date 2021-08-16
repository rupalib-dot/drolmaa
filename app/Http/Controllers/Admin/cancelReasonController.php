<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Feedback;
use App\Models\CancelReasons;

class cancelReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record_list    = CancelReasons::OrderBy('created_at','DESC')->paginate(10);
        $title          = "Cancel Reasons";
        $data           = compact('title','record_list');
        return view('admin.cancelReason.cancelReason_list', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title              = "Cancel Reasons";
        $data               = compact('title');
        return view('admin.cancelReason.cancelReason_create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cancel_reasons_id)
    {
        $record_data        = CancelReasons::where('cancel_reasons_id',base64_decode($cancel_reasons_id))->first();
        $title              = "Cancel Reasons";
        $data               = compact('title','record_data');
        return view('admin.cancelReason.cancelReason_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cancel_reasons_id)
    {
        $cancel_reasons_id = base64_decode($cancel_reasons_id);
        $error_message = 	[ 
			'cancel_reasons_detail.required'   => 'Description should be required', 
            'cancel_reasons_detail.max'        => 'Description max 300 characters'
		];

		$validatedData = $request->validate([ 
			'cancel_reasons_detail' 	=> 'required|max:300',
        ], $error_message);
 
        try
		{
           
            if($cancel_reasons_id == 0)
            {   
                \DB::beginTransaction();
                    $CancelReasons = new CancelReasons();
                    $CancelReasons->fill($validatedData);
                    $CancelReasons->save();
                \DB::commit();
                return redirect()->route('cancel_reason.index')->with('Success','Cancel Reasons created successfully');
            }
            else
            { 
                $data = array( 
                    'cancel_reasons_detail'=> $request->cancel_reasons_detail, 
                ); 
                CancelReasons::where('cancel_reasons_id',$cancel_reasons_id)->update($data); 
                return redirect()->route('cancel_reason.index')->with('Success','Cancel Reasons updated successfully');
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
    public function destroy($cancel_reasons_id)
    {
        CancelReasons::where('cancel_reasons_id',base64_decode($cancel_reasons_id))->delete();
        return redirect()->route('cancel_reason.index')->with('Success','Cancel Reasons deleted successfully');
    }
}
