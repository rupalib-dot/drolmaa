<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Faq;
use App\Models\OrderDetail;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $record_list    = Faq::OrderBy('created_at','desc')->paginate(10);
        $title          = "FAQ's";
        $data           = compact('title','record_list');
        return view('admin.faq.faq_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title          = "Create FAQ";
        $data           = compact('title');
        return view('admin.faq.faq_create', $data);
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
    public function edit($faq_id)
    {
        $record_data    = Faq::where('faq_id',base64_decode($faq_id))->first(); 
        $title          = "Edit FAQ";
        $data           = compact('title','faq_id','record_data');
        return view('admin.faq.faq_create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function update(Request $request, $faq_id)
    {
        $faq_id = base64_decode($faq_id);
        $error_message = 	[
			'faq_question.required'     => 'Question should be required',
			'faq_answer.required'       => 'Answer should be required',
		];

		$validatedData = $request->validate([
			'faq_question' 	    => 'required|max:100',
			'faq_answer' 	    => 'required|max:700',
        ], $error_message);

        try
		{
                
            if($faq_id == 0)
            {   
                \DB::beginTransaction();
                    $faq = new Faq();
                    $faq->fill($validatedData)->save();
                \DB::commit();
                return redirect()->route('faq.index')->with('Success','FAQ created successfully');
            }
            else
            {  
                $data = array(
                    'faq_question'=>$request->faq_question,
                    'faq_answer'=> $request->faq_answer, 
                ); 
                Faq::where('faq_id',$faq_id)->update($data); 
                return redirect()->route('faq.index')->with('Success','FAQ updated successfully');
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
    public function destroy($faq_id)
    {
        Faq::where('faq_id',base64_decode($faq_id))->delete();
        return redirect()->route('faq.index')->with('Success','FAQ deleted successfully');
    } 
    
}