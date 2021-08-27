<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use DB;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    { 
        $this->Category     = new Category;  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title  = "Category";
        $category = $this->Category->category_list();  
        $data   = compact('title','category','request');
        return view('admin.category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = "Add Category"; 
        $data   = compact('title');
        return view('admin.category.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error_message = 	[
			'category_name.required'        => 'Category name should be required',
            'category_name.min'             => 'Category name should be minimum of 3 characters',
            'category_name.max'             => 'Category name should be maximum of 30 characters',
            'category_name.unique' 		   => 'Category name already exist',  
            'category_name.regex'             => 'Category name should be alphabets only',


		];

		$validatedData = $request->validate([
			'category_name' 	  => 'required|min:3|max:30|regex:/^[\pL\s\']+$/u|unique:category,category_name', 
        ], $error_message);

        
        try 
        { 
            $category = Category::create([ 
                'category_name'     => $request['category_name'],  
                'category_status'   => Config('constant.BLK_UNBLK.UNBLOCK'),
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);  
            // print_r($category['category_id']);exit;
            if(!empty($category['category_id'])){
                if($request->hasFile('category_image'))
                {
                    $sImages     = $request->file('category_image'); 
                    $category_pic = time() * rand() . '.' . $sImages->getClientOriginalExtension();
                    $sImages->move(public_path('category'), $category_pic);  

                    $category = Category::where('category_id',$category['category_id'])->update(['category_image'   => $category_pic]);  
                } 
                return redirect()->route('category.index')->with('Success','Category created Successfully.'); 
            }
            else{
                return redirect()->back()->withInput($request->all())->with('Failed','Something went wrong!!!, Please try again.');
            }
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
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
    public function edit($id)
    {
        $title  = "Edit Category";
        $category = Category::find($id);   
        $data   = compact('title','category');
        return view('admin.category.edit', $data);
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
        $error_message = 	[
			'category_name.required'        => 'Category name should be required',
            'category_name.min'             => 'Category name should be minimum of 3 characters',
            'category_name.max'             => 'Category name should be maximum of 30 characters',
            'category_name.regex'             => 'Category name should be alphabets only',
            'category_name.unique' 		   => 'Category name already exist',  
		];

		$validatedData = $request->validate([
			'category_name' 	  => 'required|min:3|max:30|regex:/^[\pL\s\']+$/u|unique:category,category_name,'.$id.',category_id', 
        ], $error_message);

        
        try 
        { 
            $category = Category::where('category_id',$id)->update([ 
                'category_name'     => $request['category_name'],   
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);  
            if($request->hasFile('category_image'))
            {
                $sImages     = $request->file('category_image');  
                $category_pic = time() * rand() . '.' . $sImages->getClientOriginalExtension(); 
                $sImages->move(public_path('category'), $category_pic);
                
                
                Category::where('category_id',$id)->update(['category_image' => $category_pic]);  
            } 
            if(!empty($category)){ 
                return redirect()->route('category.index')->with('Success','Category updated Successfully.'); 
            }
            else{
                return redirect()->back()->withInput($request->all())->with('Failed','Something went wrong!!!, Please try again.');
            }
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $category_data = Category::where('category_id',$id)->update([
            'deleted_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]); 
        if(!empty($category_data)){
            return redirect()->route('category.index')->with('Success', 'Category Deleted Successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }

    public function changeStatus(Request $request,$id,$status)
    {
        $category_data = Category::where('category_id',$id)->update([
            'category_status'    => $status,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]); 
        if(!empty($category_data)){
            return redirect()->route('category.index')->with('Success', 'Category '.ucwords(strtolower(array_search($status,config('constant.BLK_UNBLK')))).' Successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }
}
