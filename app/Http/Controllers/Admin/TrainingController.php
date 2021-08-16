<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Training;
use App\Models\OrderDetail;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record_list    = Training::OrderBy('created_at','desc')->paginate(10);
        $title          = "Training";
        $data           = compact('title','record_list');
        return view('admin.training.training_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title          = "Training";
        $data           = compact('title');
        return view('admin.training.training_create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($training_id)
    {
        $record_data    = Training::where('training_id',base64_decode($training_id))->first();
        $title          = "Training";
        $data           = compact('title','training_id','record_data');
        return view('admin.training.training_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $training_id)
    {
        $training_id = base64_decode($training_id);
        $error_message = 	[
			'training_title.required' 		=> 'Training title should be required',
			'training_file.required' 	    => 'Training image should be required',
			'mimes' 	                    => 'Image type should be jpg, jpeg, png,webp',
		];

		$rules = [
			'training_title' 	=> 'required',
		];

        if($training_id != 0)
        {
            $rules['training_file'] = 'mimes:jpeg,jpg,png,webp';
        }
        else
        {
            $rules['training_file'] = 'required|mimes:jpeg,jpg,png,webp';
        }

        $this->validate($request, $rules, $error_message);

        if(!empty($request->file('training_file')))
        {
            $imageName = time().'_'.rand(1111,9999).'.'.$request->file('training_file')->getClientOriginalExtension();  
            $request->file('training_file')->move(public_path('training'), $imageName);  
        }else{
            if($training_id == 0)
            {
                $imageName="";
            }
            else
            {
                $image  = Training::where('training_id',$training_id)->first();
                $imageName=$image->training_image;
            }
        }

        if($training_id == 0)
        {
            \DB::beginTransaction();
				$training = new Training();
				$training->fill($request->all());
				$training->training_image 	= $imageName;
				$training->save();
			\DB::commit();
            
            return redirect()->route('training.index')->with('Success','Training created successfully');
        }
        else
        {  
            $data = array(
                'training_title'=>$request->training_title,
                'training_image'=> $imageName,
            ); 
            $count_row  = Training::where('training_id',$training_id)->update($data); 
            return redirect()->route('training.index')->with('Success','Training updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($training_id)
    {
        $training = Training::where('training_id',base64_decode($training_id))->delete();
        return redirect()->route('training.index')->with('Success','Training deleted successfully');
    }
}